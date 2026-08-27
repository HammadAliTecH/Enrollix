<!-- NAVBAR -->
<div class="row g-0">
    <div class="col-lg-12 nav_bar g-0">

        <div class="d-flex justify-content-between align-items-center h-100 px-4">

            <div class="navbar_title">
                <h2 class="mb-0 navbar_brand">Enrollix</h2>
                <p class="mb-0 navbar_sub">Student Management Dashboard</p>
            </div>

            <div class="d-flex align-items-center gap-3">

                <button class="icon_btn" type="button" aria-label="Notifications">
                    <i class="ri-notification-3-line"></i>
                    <span class="notif_dot"></span>
                </button>

                <!-- Profile Dropdown -->
                <div class="dropdown">

                    <div class="profile_area d-flex align-items-center gap-2"
                         role="button"
                         id="profileDropdownToggle"
                         data-bs-toggle="dropdown"
                         aria-expanded="false">

                        <div class="img_box">
                            <img src="{{ asset('asset/files/profile-shot-of-a-beautiful-young-brunette-with-wind-swept-hair-against-a-white-backdrop-photo.jpg') }}"
                                 class="img-fluid h-100 w-100"
                                 alt="Profile picture">
                        </div>

                        <div class="profile_text">
                            <p class="name_text mb-0">{{ auth()->user()->name }}</p>
                            <p class="role_text mb-0">{{ auth()->user()->roles->first()->name }}</p>
                        </div>

                        <i class="ri-arrow-down-s-line caret_icon"></i>

                    </div>

                    <ul class="dropdown-menu dropdown-menu-end profile_dropdown" aria-labelledby="profileDropdownToggle">

                        <li>
                            <div class="drop_profile d-flex align-items-center gap-2 px-3">
                                <div class="img_box img_box_sm">
                                    <img src="{{ asset('asset/files/profile-shot-of-a-beautiful-young-brunette-with-wind-swept-hair-against-a-white-backdrop-photo.jpg') }}"
                                         class="img-fluid h-100 w-100"
                                         alt="">
                                </div>
                                <div>
                                    <p class="mb-0 drop_name">{{ auth()->user()->name }}</p>
                                    <p class="mb-0 drop_role">{{ auth()->user()->roles->first()->name }}</p>
                                </div>
                            </div>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item" href="#"><i class="ri-user-line"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ri-settings-3-line"></i> Settings</a></li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                             <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                       <i class="ri-logout-box-r-line"></i> Logout
                    </x-responsive-nav-link>
                </form>
            </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>
</div>