<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\BaseController;
use App\Models\Activity;
use App\Models\Answer;
use App\Models\Group;
use App\Models\SchoolYear;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use function now;
use function today;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        $teacherGroups = Group::with([
            'teacher',
            'department',
            'users',
            'year',
            'schoolYear',
            'semester',
            'subjects',
        ])
            // ->whereHas('schoolYear', function (Builder $query) {
            //    $query
            //        ->whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
            //        ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'));
            // })
            ->whereHas('subjects', function (Builder $query) {
                $query->where('teacher_id', Auth::id());
            })
            ->latest()
            ->get();

        $teacherGroupIds = $teacherGroups->pluck('id');

        $totalGroups = $teacherGroups->count();

        $totalStudents = User::whereHas('groups', function (Builder $query) use ($teacherGroupIds) {
            $query
                ->whereKey($teacherGroupIds);
            // ->whereHas('schoolYear', function (Builder $subQuery) {
            //    $subQuery->whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
            //        ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'));
            // });
        })->count();

        $currentSemester = SchoolYear::whereDate('started_at', '<=', today('Asia/Phnom_Penh'))
            ->whereDate('finished_at', '>=', today('Asia/Phnom_Penh'))
            ->first();

        $groupData = [];
        for ($i = 0; $i < $teacherGroups->count() && $i < 3; $i++) {
            $groupData[] = [
                'id' => $teacherGroups[$i]['id'],
                'name' => $teacherGroups[$i]['name'],
                'year' => $teacherGroups[$i]['year']['name'],
                'school_year' => $teacherGroups[$i]['schoolYear']['name'],
                'semester' => $teacherGroups[$i]['semester']['name'],
                'subject' => $teacherGroups[$i]['subjects'][0]['name'],
                'department' => $teacherGroups[$i]['department']['name'],
                'total_students' => $teacherGroups[$i]['users']->count(),
            ];
        }

        return $this->successResponse([
            'total_groups' => $totalGroups,
            'total_students' => $totalStudents,
            'current_semester' => $currentSemester,
            'groups' => $groupData,
        ]);
    }

    public function getGroups()
    {
        $groups = Group::with(['teacher', 'users', 'year'])->get();

        $data = [];

        foreach ($groups as $group) {
            $data[] = [
                'id' => $group->id,
                'name' => $group->name,
                'total_students' => $group->users->count(),
                'year' => $group->year->name,
                'semester' => $group->semester->name,
                'school_year' => $group->schoolYear->name,
            ];
        }

        return $this->successResponse($data);
    }

    public function getActivities(Request $request)
    {
        $departmentId = $request->query('department');
        $schoolYearId = $request->query('schoolYear');
        $yearId = $request->query('year');
        $groupName = $request->query('groupName');

        $query = Activity::with(['form', 'subject', 'groups' => ['year', 'schoolYear', 'semester']])
            ->where('teacher_id', Auth::id());

        if ($departmentId || $schoolYearId || $yearId || $groupName) {
            $query->whereHas('groups', function (Builder $query) use ($groupName, $schoolYearId, $yearId, $departmentId) {
                if ($departmentId) {
                    $query->where('department_id', $departmentId);
                }
                if ($schoolYearId) {
                    $query->where('school_year_id', $schoolYearId);
                }
                if ($yearId) {
                    $query->where('year_id', $yearId);
                }
                if ($groupName) {
                    $query->where('name', 'ILIKE', "%$groupName%");
                }
            });
        }

        $activities = $query
            ->latest('due_at')
            ->get();

        $data = [];
        foreach ($activities as $activity) {
            $data[] = [
                'id' => $activity->id,
                'weight' => $activity->weight,
                'title' => $activity->form->title,
                'due_at' => $activity->due_at,
                'duration' => $activity->duration,
                'subject' => $activity->subject->name,
                'groups' => $activity->groups,
                'is_past_due' => Carbon::parse($activity->due_at, 'Asia/Phnom_Penh')->isPast(),
            ];
        }

        return $this->successResponse($data);
    }

    public function getOneActivity(Activity $activity)
    {
        $questions = [];
        foreach ($activity->form->questions as $question) {
            $options = [];
            foreach ($question->options as $option) {
                $options[] = [
                    'id' => $option->id,
                    'name' => $option->name,
                    'is_correct' => $option->is_correct,
                ];
            }

            $questions[] = [
                'id' => $question->id,
                'name' => $question->name,
                'type' => $question->type,
                'is_require' => $question->is_required,
                'correct_answer' => $question->correct_answer,
                'points' => $question->points,
                'options' => $options,
            ];
        }

        $formId = $activity->form->id;

        $groups = Group::whereHas('activities.form', function (Builder $query) use ($formId) {
            $query->where('id', $formId);
        })->get()->transform(function (Group $group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'school_year' => $group->schoolYear->name,
                'year' => $group->year->name,
                'semester' => $group->semester->name,
            ];
        });

        return [
            'id' => $activity->id,
            'weight' => $activity->weight,
            'duration' => $activity->duration,
            'due_at' => $activity->due_at,
            'groups' => $groups,
            'subject' => [
                'id' => $activity->subject->id,
                'name' => $activity->subject->name,
            ],
            'activity_type' => [
                'id' => $activity->activity_type_id,
                'name' => $activity->activityType->name,
            ],
            'title' => $activity->form->title,
            'description' => $activity->form->description,
            'questions' => $questions,
        ];
    }

    public function getOneActivityDashboard(Activity $activity)
    {
        $questionIds = $activity->form->questions->pluck('id');
        $totalSubmitted = Answer::whereIn('question_id', $questionIds)->count();
        $avgScore = Answer::whereIn('question_id', $questionIds)->avg('score');
        $teacherGroupIds = Group::with('teacher')->whereRelation('activities', 'id', $activity->id)->pluck('id');
        $students = User::whereHas('groups', function (Builder $query) use ($teacherGroupIds) {
            $query->whereIn('id', $teacherGroupIds);
        })->get();
        $studentsArr = [];
        foreach ($students as $student) {
            $answers = Answer::where('user_id', $student->id)->whereHas('question.form', function (Builder $query) use ($activity) {
                $query->where('id', $activity->form->id);
            })->get();
            $score = 0;
            foreach ($answers as $answer) {
                $score += $answer->score;
            }
            $studentsArr[] = [
                'id' => $student->id,
                'name' => $student->name,
                'status' => $answers->isNotEmpty() ? 'submitted' : 'not submitted',
                'score' => $score,
                'submit_date' => $answers?->first()?->created_at ?? null,
                'group' => $student->groups()->whereIn('id', $teacherGroupIds)->first()->name,
            ];
        }

        return [
            'id' => $activity->id,
            'weight' => $activity->weight,
            'title' => $activity->form->title,
            'description' => $activity->form->description,
            'subject' => $activity->subject,
            'due_at' => $activity->due_at,
            'duration' => $activity->duration,
            'total_submitted' => $totalSubmitted,
            'avg_scores' => $avgScore,
            'students' => $studentsArr,
        ];
    }

    public function getScoresBySubjectGroup(Subject $subject, Group $group)
    {
        $users = User::whereHas('groups', function ($query) use ($group, $subject) {
            $query->where('id', $group->id)
                ->whereHas('subjects', function ($query) use ($subject) {
                    $query->where('id', $subject->id);
                });
        })->with([
            'groups' => function ($query) use ($group, $subject) {
                $query->where('id', $group->id)
                    ->whereHas('subjects', function ($query) use ($subject) {
                        $query->where('id', $subject->id);
                    })->with('activities.form.questions.answers');
            },
        ])->get();

        $data = [];
        foreach ($users as $user) {
            $activities = [];
            foreach ($user->groups->first()->activities()->where('teacher_id', Auth::id())->get() as $activity) {
                $sum = 0;
                $fullScore = 0;
                foreach ($activity->form->questions as $question) {
                    $fullScore += $question->points;
                    $sum += $question->answers->where('user_id', $user->id)->first()->score ?? 0;
                }

                $activities[] = [
                    'id' => $activity->id,
                    'name' => $activity->form->title,
                    'scores' => $sum,
                ];
            }

            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'activities' => $activities,
            ];
        }

        return $this->successResponse($data);
    }

    public function promoteStudents(Request $request)
    {
        $request->validate([
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
            'score_pass' => ['required', 'integer', 'max:100'],
        ]);

        $users = User::whereHas('groups', function ($query) use ($request) {
            $query->where('id', $request->input('group_id'))
                ->whereHas('subjects', function ($query) use ($request) {
                    $query->where('id', $request->input('subject_id'));
                });
        })->with([
            'groups' => function ($query) use ($request) {
                $query->where('id', $request->input('group_id'))
                    ->whereHas('subjects', function ($query) use ($request) {
                        $query->where('id', $request->input('subject_id'));
                    })->with('activities.form.questions.answers');
            },
        ])->get();

        $data = [];
        foreach ($users as $user) {
            $activities = [];
            foreach ($user->groups->first()->activities as $activity) {
                $sum = 0;
                $fullScore = 0;
                foreach ($activity->form->questions as $question) {
                    $fullScore += $question->points;
                    $sum += $question->answers->where('user_id', $user->id)->first()->score ?? 0;
                }

                $activities[] = [
                    'id' => $activity->id,
                    'name' => $activity->form->title,
                    'scores' => $sum / $fullScore * $activity->weight,
                ];
            }

            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'activities' => $activities,
            ];
        }

        foreach ($data as $item) {
            $totalScore = 0;
            foreach ($item['activities'] as $activity) {
                $totalScore += $activity['scores'];
            }
            if ($totalScore >= $request->input('score_pass')) {
                StudentDetail::create([
                    'is_passed' => true,
                    'user_id' => $item['id'],
                    'subject_id' => $request->input('subject_id'),
                    'group_id' => $request->input('group_id'),
                ]);
            } else {
                StudentDetail::create([
                    'is_passed' => false,
                    'user_id' => $item['id'],
                    'subject_id' => $request->input('subject_id'),
                    'group_id' => $request->input('group_id'),
                ]);
            }
        }

        $subjectCount = Group::find($request->input('group_id'))->subjects->count();
        foreach ($data as $item) {
            $count = StudentDetail::where('user_id', $item['id'])
                ->where('subject_id', $request->input('subject_id'))
                ->where('group_id', $request->input('group_id'))
                ->where('is_passed', true)
                ->count();

            if ($subjectCount >= 0.75 * $count) {
                $inputGroup = Group::find($request->input('group_id'));
                $dataToCreate = [];
                if ($inputGroup->semester->name === 'Semester 1') {
                    $dataToCreate['semester_id'] = 2;
                    $dataToCreate['year_id'] = $inputGroup->year_id;
                    $dataToCreate['school_year_id'] = $inputGroup->school_year_id;
                    $dataToCreate['name'] = $inputGroup->name;
                    $dataToCreate['department_id'] = $inputGroup->department_id;
                } elseif ($inputGroup->semester->name === 'Semester 2') {
                    if (preg_match('/(\d{4})-(\d{4})/', $inputGroup->schoolYear->name, $matches)) {
                        $start = (int) $matches[1] + 1;
                        $end = (int) $matches[2] + 1;
                        $updated = "{$start}-{$end}";
                    } else {
                        echo 'Invalid format!';
                    }

                    $sYear = SchoolYear::where('name', $updated)->firstOrFail();

                    $dataToCreate['semester_id'] = 1;
                    $dataToCreate['year_id'] = $inputGroup->year_id + 1;
                    $dataToCreate['school_year_id'] = $sYear->id;
                    $dataToCreate['name'] = $inputGroup->name;
                    $dataToCreate['department_id'] = $inputGroup->department_id;
                }

                $g = Group::firstOrCreate($dataToCreate);
                User::find($item['id'])->groups()->syncWithoutDetaching($g);
            }
        }

        return $this->successResponse([]);
    }

    public function getProfile()
    {
        $user = Auth::user();
        $group = $user->groups()->whereHas('schoolYear', function (Builder $query) {
            $query->whereDate('started_at', '<=', now('Asia/Phnom_Penh'))
                ->whereDate('finished_at', '>=', now('Asia/Phnom_Penh'));
        })->first();

        return $this->successResponse([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image_url,
            'faculty' => $user->userAffiliations->first()->faculty->name,
            'department' => $user->userAffiliations->first()?->department?->name,
        ]);
    }
}
