<!DOCTYPE html>
    <html>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <style>
            .sidebar {
                background-color: #3c706f; /* Dark background color */
                display: flex;
                flex-direction: column;
                height: 100vh; /* Set sidebar height to full viewport height */
                position: fixed; /* Fixed positioning so it remains visible while scrolling */
                transition: left 0.3s ease-in-out;
            }
    
            .sidebar-sticky {
                flex-grow: 1;
                overflow-y: auto; /* Enable vertical scrolling if content exceeds sidebar height */
            }
    
            .nav-link {
                color: white; /* White text color for links */
                display: block;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 10px; /* Rounded corners */
                transition: background-color 0.3s, color 0.3s;
            }
    
            .nav-link:hover {
                background-color: #FFD700; /* Yellow background on hover */
                color: black; /* Black text color on hover */
            }
    
            .dropdown-menu {
                background-color: #3C3C3C; /* Same background as sidebar */
                border: none; /* Remove border */
                box-shadow: none; /* Remove shadow */
            }
    
            .dropdown-item {
                color: white; /* White text color for dropdown items */
                border-radius: 10px; /* Rounded corners for dropdown items */
                transition: background-color 0.3s, color 0.3s;
            }
    
            .dropdown-item:hover {
                background-color: #FFD700; /* Yellow background on hover */
                color: black; /* Black text color on hover */
            }
    
            .sidebar-toggle {
                display: none; /* Hide toggle button by default */
                background-color: #3C3C3C;
                border: none;
                padding: 10px;
                font-size: 24px;
                cursor: pointer;
                position: absolute;
                top: 10px;
                left: 10px;
            }
    
            .sidebar-collapsed {
                width: 0;
                overflow: hidden;
            }
    
            @media (max-width: 768px) {
                .sidebar {
                    width: 250px;
                    height: 100%;
                    position: fixed;
                    left: -250px;
                }
    
                .sidebar-active {
                    left: 0;
                }
    
                .sidebar-toggle {
                    display: block; /* Show toggle button on smaller screens */
                }
            }
    
            .sub-menu {
                display: none; /* Hide sub-menu by default */
                padding-left: 20px;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease-in-out;
            }
    
            .sub-menu-active {
                display: block;
                max-height: 200px; /* Adjust as needed to ensure all items fit */
            }
    
            .arrow {
                margin-left: auto;
                transition: transform 0.3s ease-in-out;
            }
    
            .arrow-down {
                transform: rotate(90deg);
            }
    
            .nav-item-reservation {
                cursor: pointer;
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
                        <a class="nav-link" href="{{ route('interviewer.dashboard') }}">
                            <i class="lni lni-home"></i>
                            <span class="nav-link-text">Home</span>
                        </a>
                    </li>
    
    
                    <li class="nav-item nav-item-asset pb-4">
                        <a class="nav-link">
                            <i class="fa-solid fa-list"></i>
                            <span class="nav-link-text">Results</span>
                            <i class="fas fa-chevron-right arrow"></i>
                        </a>
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item pb-2">
                                <a class="nav-link" href="{{ route('interviewer.recommendList') }}">
                                    <span class="nav-link-text">Recommended</span>
                                </a>
                            </li>
                        </ul>
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