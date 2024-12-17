<div class="row">
    <div class="col-lg-3 col-6">
        <livewire:home.subject-statistic-card :subject_count="$subject_count"/>
    </div>
    <div class="col-lg-3 col-6">
        <livewire:home.group-statistic-card :group_count="$group_count"/>
    </div>
    <div class="col-lg-3 col-6">
        <livewire:home.teacher-statistic-card :teacher_count="$teacher_count"/>
    </div>
    <div class="col-lg-3 col-6">
        <livewire:home.student-statistic-card :student_count="$student_count"/>
    </div>
</div>

