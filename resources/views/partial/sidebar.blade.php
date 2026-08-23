<!-- SIDEBAR -->
<div class="col-lg-2 g-0">

    <aside class="side_bar w-100">

        <div class="brand_block d-flex align-items-center gap-2 px-3">
            <div class="brand_mark">E</div>
            <div>
                <h5 class="brand_name mb-0">Enrollix</h5>
                <span class="brand_tag">Admin Suite</span>
            </div>
        </div>

        <nav class="nav_scroll mt-2" id="sidebarAccordion">

            <ul class="w-100">

                <li>
                    <a class="options_heading dashboard_head">
                        <span><i class="ri-dashboard-line"></i> Dashboard</span>
                    </a>
                </li>

                <li class="nav_group">
                    <a href="#userManagement"
                       data-bs-toggle="collapse"
                       class="options_heading {{ request()->routeIs('add_user', 'add_role', 'role_permission', 'user_role') ? 'active_1' : '' }}">
                        <span>
                            <i class="ri-group-line"></i>
                            Team
                        </span>
                        <i class="ri-arrow-down-s-line arrow"></i>
                    </a>

                    <ul class="collapse {{ request()->routeIs('add_user', 'add_role', 'role_permission', 'user_role') ? 'show' : '' }}"
                        id="userManagement"
                        data-bs-parent="#sidebarAccordion">

                        <li class="inner_options">
                            <a href="{{ route('add_role') }}"
                               class="user_inner {{ request()->routeIs('add_role') ? 'hight_light' : '' }}">
                                Add Roles
                            </a>
                        </li>

                        <li class="inner_options">
                            <a href="{{ route('role_permission') }}"
                               class="user_inner {{ request()->routeIs('role_permission') ? 'hight_light' : '' }}">
                                Role Permissions
                            </a>
                        </li>

                        <li class="inner_options">
                            <a href="{{ route('add_user') }}"
                               class="user_inner {{ request()->routeIs('add_user') ? 'hight_light' : '' }}">
                                Users
                            </a>
                        </li>

                        <li class="inner_options">
                            <a href="{{ route('user_role') }}"
                               class="user_inner {{ request()->routeIs('user_role') ? 'hight_light' : '' }}">
                                User Roles
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav_group">
                    <a href="#courseManagement"
                       data-bs-toggle="collapse"
                       class="options_heading {{ request()->routeIs('course.create', 'course.index', 'instructor_list') ? 'active_1' : '' }}">
                        <span>
                            <i class="ri-book-open-line"></i>
                            Courses
                        </span>
                        <i class="ri-arrow-down-s-line arrow"></i>
                    </a>

                    <ul class="collapse {{ request()->routeIs('course.create', 'course.index', 'instructor_list') ? 'show' : '' }}"
                        id="courseManagement"
                        data-bs-parent="#sidebarAccordion">

                        <li class="inner_options {{ request()->routeIs('course.create') ? 'hight_light' : '' }}">
                            <a href="{{ route('course.create') }}" class="user_inner">
                                Add Courses
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('course.index') ? 'hight_light' : '' }}">
                            <a href="{{ route('course.index') }}" class="user_inner">
                                Navigate Courses
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('instructor_list') ? 'hight_light' : '' }}">
                            <a href="{{ route('instructor_list') }}" class="user_inner">
                                Instructors
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav_group">
                    <a href="#studentManagement"
                       data-bs-toggle="collapse"
                       class="options_heading {{ request()->routeIs('student.create', 'student.index', 'make_enrollment', 'student_course.index') ? 'active_1' : '' }}">
                        <span>
                            <i class="ri-graduation-cap-line"></i>
                            Students
                        </span>
                        <i class="ri-arrow-down-s-line arrow"></i>
                    </a>

                    <ul class="collapse {{ request()->routeIs('student.create', 'student.index', 'make_enrollment', 'student_course.index') ? 'show' : '' }}"
                        id="studentManagement"
                        data-bs-parent="#sidebarAccordion">

                        <li class="inner_options {{ request()->routeIs('student.create') ? 'hight_light' : '' }}">
                            <a href="{{ route('student.create') }}" class="user_inner">
                                Add Students
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('student.index') ? 'hight_light' : '' }}">
                            <a href="{{ route('student.index') }}" class="user_inner">
                                Student List
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('make_enrollment') ? 'hight_light' : '' }}">
                            <a href="{{ route('make_enrollment') }}" class="user_inner">
                                Make Enrollment
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('student_course.index') ? 'hight_light' : '' }}">
                            <a href="{{ route('student_course.index') }}" class="user_inner">
                                Enrollment List
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav_group">
                    <a href="#financeManagement"
                       data-bs-toggle="collapse"
                       class="options_heading {{ request()->routeIs('payment_plan.index', 'payment_history.index', 'pay_fee') ? 'active_1' : '' }}">
                        <span>
                            <i class="ri-money-dollar-circle-line"></i>
                            Finance
                        </span>
                        <i class="ri-arrow-down-s-line arrow"></i>
                    </a>

                    <ul class="collapse {{ request()->routeIs('payment_plan.index', 'payment_history.index', 'pay_fee') ? 'show' : '' }}"
                        id="financeManagement"
                        data-bs-parent="#sidebarAccordion">

                        <li class="inner_options {{ request()->routeIs('payment_plan.index') ? 'hight_light' : '' }}">
                            <a href="{{ route('payment_plan.index') }}" class="user_inner">
                                Fee Book
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('pay_fee') ? 'hight_light' : '' }}">
                            <a href="{{ route('pay_fee') }}" class="user_inner">
                                Pay Fee
                            </a>
                        </li>

                        <li class="inner_options {{ request()->routeIs('payment_history.index') ? 'hight_light' : '' }}">
                            <a href="{{ route('payment_history.index') }}" class="user_inner">
                                Payment History
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav_group">
                    <a href="#logManagement"
                       data-bs-toggle="collapse"
                       class="options_heading">
                        <span>
                            <i class="ri-history-line"></i>
                            Logs
                        </span>
                        <i class="ri-arrow-down-s-line arrow"></i>
                    </a>

                    <ul class="collapse {{ request()->routeIs('activity_log') ? 'show' : '' }}"
                        id="logManagement"
                        data-bs-parent="#sidebarAccordion">

                        <li class="inner_options">
                            <a href="" class="user_inner">
                                Log History
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>

        </nav>

    </aside>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const headings = document.querySelectorAll('.options_heading[data-bs-toggle="collapse"]');

    headings.forEach(function (heading) {
        // sirf ek heading active rahe click par
        heading.addEventListener('click', function () {
            headings.forEach(h => h.classList.remove('active_1'));
            this.classList.add('active_1');
        });

        // arrow ko collapse ke show/hide ke sath rotate karo
        const targetId = heading.getAttribute('href');
        const collapseEl = targetId ? document.querySelector(targetId) : null;

        if (collapseEl) {
            if (collapseEl.classList.contains('show')) {
                heading.classList.add('open');
            }
            collapseEl.addEventListener('show.bs.collapse', function () {
                heading.classList.add('open');
            });
            collapseEl.addEventListener('hide.bs.collapse', function () {
                heading.classList.remove('open');
            });
        }
    });
});
</script>