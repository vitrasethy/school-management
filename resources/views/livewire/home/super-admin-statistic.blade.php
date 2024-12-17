<div class="row">
    <div class="col-lg-3 col-6">
        <livewire:home.school-statistic-card :school_count="$school_count"/>
    </div>
    <div class="col-lg-3 col-6">
        <livewire:home.department-statistic-card :department_count="$department_count"/>
    </div>
    <div class="col-lg-3 col-6">
        <livewire:home.group-statistic-card :group_count="$group_count"/>
    </div>
    <div class="col-lg-3 col-6">
        <livewire:home.user-statistic-card :user_count="$user_count"/>
    </div>
</div>
