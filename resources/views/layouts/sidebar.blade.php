<div class="sidebar-wrapper" data-layout="stroke-svg">

    <div class="logo-wrapper">
        <a href="/dashboard">
            <img class="img-fluid" width="40px" src="{{ asset('dashboard_assets/assets/images/logo/logo.png') }}"
                alt="" style="width: 50px; margin-top: -10px">
        </a>
        <div class="back-btn">
            <i class="fa fa-angle-left"> </i>
        </div>
        <div class="toggle-sidebar">
            <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
        </div>
    </div>


    <div class="logo-icon-wrapper">
        <a href="index.html">
            <img class="img-fluid" style="width: 50px"
                src="{{ asset('dashboard_assets/assets/images/logo/logo-icon.png') }}" alt="">
        </a>
    </div>

    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">

                <li class="back-btn">
                    <a href="index.html">
                        <img class="img-fluid" src="{{ asset('dashboard_assets/assets/images/logo/logo-icon.png') }}"
                            alt="" style="width: 50px">
                    </a>
                    <div class="mobile-back text-end">
                        <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                </li>
                <li class="pin-title sidebar-main-title">
                    <div>
                        <h6>Pinned</h6>
                    </div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('/home') ? 'active' : '' }}"
                        href="/home">
                        <i class="fa fa-home text-white me-2" aria-hidden="true"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('index') ? 'active' : '' }}"
                        href="/index">
                        <i class="fa fa-list-alt text-white me-2" aria-hidden="true"></i>
                        <span>Index</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('faq') ? 'active' : '' }}"
                        href="/faq">
                        <i class="fa fa-question-circle text-white me-2" aria-hidden="true"></i>
                        <span>FAQ</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('quiz') ? 'active' : '' }}"
                        href="/quiz">
                        <i class="fa fa-check-square text-white me-2" aria-hidden="true"></i>
                        <span>Quiz</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('panduan') ? 'active' : '' }}"
                        href="/panduan">
                        <i class="fa-solid fa-book-open text-white me-2"></i>
                        <span>Panduan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('developers') ? 'active' : '' }}"
                        href="/developers">
                        <i class="fa fa-code text-white me-2" aria-hidden="true"></i>
                        <span>Developers</span>
                    </a>
                </li>


            </ul>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</div>
