<!DOCTYPE html>
    <html>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <style>
            .sidebar {
                background: linear-gradient(to bottom, #3c706f, #2a5150);
                display: flex;
                flex-direction: column;
                height: 100vh;
                position: fixed;
                width: 280px;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }
    
            .sidebar-sticky {
                flex-grow: 1;
                overflow-y: auto;
                padding: 1rem;
            }
    
            .nav-link {
                color: rgba(255, 255, 255, 0.9);
                display: flex;
                align-items: center;
                padding: 12px 16px;
                margin: 4px 0;
                text-decoration: none;
                border-radius: 8px;
                transition: all 0.3s ease;
                font-weight: 500;
            }
    
            .nav-link i {
                margin-right: 12px;
                font-size: 1.2rem;
            }
    
            .nav-link:hover {
                background-color: rgba(255, 215, 0, 0.9);
                color: #000;
                transform: translateX(5px);
            }
    
            .sub-menu {
                margin-left: 1rem;
                padding-left: 1rem;
                border-left: 2px solid rgba(255, 255, 255, 0.1);
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
    
            .sub-menu-active {
                max-height: 500px;
                margin-top: 0.5rem;
                margin-bottom: 0.5rem;
            }
    
            .sub-menu .nav-link {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
    
            .arrow {
                margin-left: auto;
                transition: transform 0.3s ease;
                opacity: 0.8;
            }
    
            .arrow-down {
                transform: rotate(90deg);
            }
    
            @media (max-width: 768px) {
                .sidebar {
                    left: -280px;
                    width: 280px;
                }
    
                .sidebar-active {
                    left: 0;
                    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
                }
    
                .sidebar-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 45px;
                    height: 45px;
                    background: #3c706f;
                    border-radius: 8px;
                    color: white;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    transition: all 0.3s ease;
                }
    
                .sidebar-toggle:hover {
                    background: #2a5150;
                    transform: scale(1.05);
                }
            }
    
            /* Custom scrollbar for sidebar */
            .sidebar-sticky::-webkit-scrollbar {
                width: 6px;
            }
    
            .sidebar-sticky::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
            }
    
            .sidebar-sticky::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.2);
                border-radius: 3px;
            }
    
            .sidebar-sticky::-webkit-scrollbar-thumb:hover {
                background: rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body>
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
    
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <!-- Sidebar content -->
                    <li class="nav-item py-4">
                        <a class="nav-link" href="{{ route('applicant.home') }}">
                            <i class="lni lni-home"></i>
                            <span class="nav-link-text">Home</span>
                        </a>
                    </li>
    
    
                    <li class="nav-item nav-item-asset pb-4">
                        <a class="nav-link">
                          <i class="lni lni-clipboard"></i>
                            <span class="nav-link-text">Application Form</span>
                            <i class="fas fa-chevron-right arrow"></i>
                        </a>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item pb-2">
                                <a class="nav-link" href="{{ route('personal.form') }}">
                                    <span class="nav-link-text">Personal Details</span>
                                </a>
                            </li>
                            <li class="nav-item pb-2">
                                <a class="nav-link" href="{{ route('academic.form') }}">
                                    <span class="nav-link-text">Academic Details</span>
                                </a>
                            </li>
                            <li class="nav-item pb-2">
                                <a class="nav-link" href="{{ route('cocuriculum.form') }}">
                                    <span class="nav-link-text">Extra- Curricular Activities</span>
                                </a>
                            </li>
                            <li class="nav-item pb-2">
                              <a class="nav-link" href="{{ route('parent.form') }}">
                                  <span class="nav-link-text">Details of Parents/Guardian</span>
                              </a>
                          </li>
                          <li class="nav-item pb-2">
                            <a class="nav-link" href="{{ route('siblings.form') }}">
                                <span class="nav-link-text">Details of Sibling</span>
                            </a>
                        </li>
                        </ul>
                    </li>
                
                    <li class="nav-item pb-4">
                        <a class="nav-link" href="{{ route('applicant.declaration') }}">
                            <i class="lni lni-user"></i>
                            <span class="nav-link-text">Declaration</span>
                        </a>
                    </li>
    
                </ul>
            </div>
        </nav>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Enable dropdown on hover
            $(document).ready(function() {
                $('.dropdown').hover(function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
                }, function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
                });
    
                $('.nav-item-reservation').on('click', function() {
                    const subMenu = $(this).find('.sub-menu');
                    const arrow = $(this).find('.arrow');
                    
                    if (subMenu.hasClass('sub-menu-active')) {
                        subMenu.removeClass('sub-menu-active');
                        arrow.removeClass('arrow-down');
                    } else {
                        subMenu.addClass('sub-menu-active');
                        arrow.addClass('arrow-down');
                    }
                });
    
                $('.nav-item-asset').on('click', function() {
                    const subMenu = $(this).find('.sub-menu');
                    const arrow = $(this).find('.arrow');
                    
                    if (subMenu.hasClass('sub-menu-active')) {
                        subMenu.removeClass('sub-menu-active');
                        arrow.removeClass('arrow-down');
                    } else {
                        subMenu.addClass('sub-menu-active');
                        arrow.addClass('arrow-down');
                    }
                });
    
                $('.nav-item-category').on('click', function() {
                    const subMenu = $(this).find('.sub-menu');
                    const arrow = $(this).find('.arrow');
                    
                    if (subMenu.hasClass('sub-menu-active')) {
                        subMenu.removeClass('sub-menu-active');
                        arrow.removeClass('arrow-down');
                    } else {
                        subMenu.addClass('sub-menu-active');
                        arrow.addClass('arrow-down');
                    }
                });
            });
    
            function toggleSidebar() {
                $('.sidebar').toggleClass('sidebar-active');
            }
        </script>
    </body>
    </html>
