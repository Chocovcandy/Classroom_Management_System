<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Classroom Management System</title>

    <!-- Tailwind CDN (quick setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!--=============== HEADER ===============-->
    <header class="header">
        <nav class="nav container">
            <!-- Logo -->
            <a href="#" class="nav__brand">
                <img src="../assets/img/Life_Un_logo.png" alt="Life University" class="LU_logo">
            </a>
            <!-- Menu -->
            <div class="nav__menu">
                <ul class="nav__list">
                    <li><a href="#home" class="nav__link active-link">Home</a></li>
                    <li><a href="#about" class="nav__link">About</a></li>
                    <li><a href="#services" class="nav__link">Features</a></li>
                    <li><a href="#contact" class="nav__link">Contact</a></li>
                </ul>
            </div>

            <!-- Right Buttons -->
            <div class="nav__actions">
                <!-- <a href="{{ route('Login_page') }}" class="nav__login">
                    Login
                </a> -->
                <a href="{{ route('Login_page') }}" class="button" id="getStarted">
                    Get Started
                </a>
            </div>
        </nav>
    </header>



    <div>
        <main class="main">

            <!--=============== HOME ===============-->
            <section class="home section" id="home">
                <div class="home__container container">

                    <div class="home__data">

                      <h1 class="home__title">
    Smart Classroom &
    <span>Academic Collaboration</span>
    Platform
</h1>

                        <p class="home__description">
                            A unified platform connecting students, professors, HODs, and deans
                            to make academic activities easier, smarter, and more organized.
                        </p>

                        <div class="home__buttons">
                            <a href="{{ route('Login_page') }}" class="button">
                                Get Started
                            </a>
                        </div>

                    </div>

                    <div class="img_svg1">
                        <x-icons.home />
                    </div>

                </div>
            </section>




            <!--=============== ABOUT ===============-->
            <section class="about section container" id="about">
                <div class="about__container grid">
                    <div class="img_svg2">
                        <x-icons.overview />
                    </div>
                    <div class="about__data">
                        <h2 class="section__title-center">Academic System Overview</h2>
                        <p class="about__description">A unified platform connecting students, professors, HODs, and
                            deans to improve communication and make academic activities easier and more organized.
                        </p>
                    </div>

                </div>
            </section>



            <!--=============== Annoucement & Update ===============-->
            <section class="annoucement section container">
                <div class="annoucement__container grid">

                    <div class="annoucement__data">
                        <h2 class="section__title-center">
                            Announcements & Updates
                        </h2>
                        <p class="annoucement__description">
                            Publish announcements to all users in the system to deliver important updates and
                            information.
                        </p>
                    </div>
                    <div class="img_svg3">
                        <x-icons.annoucement />
                    </div>
                </div>
            </section>




            <section class="about section container" id="about">
                <div class="about__container grid">

                    <div class="img_svg4">
                        <x-icons.schedule />
                    </div>

                    <div class="about__data">
                        <h2 class="section__title-center">Schedule Management</h2>
                        <p class="about__description">Create and publish class schedules based on department and
                            academic year while preventing classroom and subject conflicts.
                    </div>

                </div>
            </section>




            <!--=============== Classroom Management Features ===============-->
            <section class="services section container" id="services">
                <h2 class="section__title">Classroom Management Features</h2>
                <div><br><br></div>
                <div class="services__container grid">
                    <!--Feature +01 -->
                    <div class="services__data">
                        <h3 class="services__subtitle">Classroom Groups</h3>
                        <div class="img_svg5">
                            <x-icons.CM_feature01 />
                        </div>
                        <p class="services__description">Professors create classroom groups, and students join using a
                            class code.
                    </div>

                    <!-- Feature +02 -->
                    <div class="services__data">
                        <h3 class="services__subtitle">Learning Activities</h3>
                        <div class="img_svg6">
                            <x-icons.CM_feature02 />
                        </div>
                        <p class="services__description">Upload learning materials, assignments, quizzes, announcements,
                            and grades.</p>
                    </div>

                    <!-- Feature +03 -->
                    <div class="services__data">
                        <h3 class="services__subtitle">Team Project Management</h3>
                        <div class="img_svg7">
                            <x-icons.CM_feature03 />
                        </div>
                        <p class="services__description">Create project teams through </br>volunteer or automatic
                            grouping.</p>
                        <div>
                        </div>
                        </dfgetiv>
                    </div>
            </section>





            <section class="contact section container" id="contact">
                <h2 class="section__title"> Our Campuses </h2>
                <p class="section__description">
                    Visit our campuses or contact us for academic information and support.
                </p>
                <div class="contact__container grid">

                    <!-- Card 1 -->
                    <div class="contact__card">
                        <img src="../assets/img/img_shv.png" class="contact__image" alt="Sihanoukville">
                        <span class="contact__badge">Main Campus</span>
                        <h3 class="contact__title">Sihanoukville</h3>
                        <p class="contact__text">
                            CT Street Mondol 3, Sangkat 2,<br>
                            Sihanoukville, Cambodia
                        </p>
                        <div class="contact__info">
                            <p>📞 034 934 498</p>
                            <p>📱 081 929 195</p>
                            <p>📱 078 966 877</p>
                            <p>✉ admin@lifeun.edu.kh</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="contact__card">
                        <img src="../assets/img/img_pp.png" class="contact__image" alt="Phnom Penh">
                        <span class="contact__badge">Branch Campus</span>
                        <h3 class="contact__title">Phnom Penh</h3>
                        <p class="contact__text">
                            Street 256 & 598, Sangkat Toul Sangke,<br> Khan Russey Keo, Phnom Penh,<br>Kingdom of
                            Cambodia.
                        </p>
                        <div class="contact__info">
                            <p>📞 010 979 722</p>
                            <p>✉ bpzavi@gmail.com</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="contact__card">
                        <img src="../assets/img/img_sl.png" class="contact__image" alt="Seoul">
                        <span class="contact__badge">Seoul, Korea Office</span>
                        <h3 class="contact__title">Seoul</h3>
                        <p class="contact__text">
                            Life University Seoul<br>
                            6F Seomun Bd. Changjun-dong Mapo-Gu Seoul Korea
                        </p>
                        <div class="contact__info">
                            <p>📞 070 7569 4937</p>
                            <p>✉ marie365happy@gmail.com</p>
                        </div>
                    </div>

                </div>
            </section>




            <!--=============== CONTACT US ===============-->
            <!-- <section class="contact section container" id="contact">
                <div class="contact__container grid">
                    <div class="contact__content">
                        <h2 class="section__title-center">Contact Us From <br> Here</h2>
                        <p class="contact__description">You can contact us from here, you can write to us,
                            call us or visit our service center, we will gladly assist you.</p>
                    </div>

                    <ul class="contact__content grid">
                        <li class="contact__address">Telephone: <span class="contact__information">999 - 888 -
                                777</span></li>
                        <li class="contact__address">Email: <span class="contact__information">delivery@email.com</span>
                        </li>
                        <li class="contact__address">Location: <span class="contact__information">Lima - Peru</span>
                        </li>
                    </ul>

                    <div class="contact__content">
                        <a href="#" class="button">Contact Us</a>
                    </div>
                </div>
            </section>
        </main> -->











            <!-- 
  
<div class="bg-white shadow-lg rounded-2xl p-10 w-full max-w-md text-center">

            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Classroom Management System
            </h1>

            <p class="text-gray-500 mb-6">
                Manage users, departments, and schedules efficiently.
            </p>

            @guest
                <div class="flex flex-col gap-3">
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                            Register (Student)
                        </a>
                    @endif
                </div>
            @endguest

            @auth
                <div class="space-y-4">
                    <p class="text-gray-700">
                        Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>
                    </p>

                    @php
                        $role = auth()->user()->roles->first()->role_name ?? null;
                    @endphp

                    @if ($role === 'Admin')
                        <a href="{{ route('admin.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to
                            Dashboard</a>

                    @elseif ($role === 'Dean')
                        <a href="{{ route('dean.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to
                            Dashboard</a>

                    @elseif ($role === 'HoD')
                        <a href="{{ route('hod.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to
                            Dashboard</a>

                    @elseif ($role === 'Professor')
                        <a href="{{ route('professor.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to
                            Dashboard</a>

                    @elseif ($role === 'Student')
                        <a href="{{ route('student.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to
                            Dashboard</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full border border-red-400 text-red-600 py-2 rounded-lg hover:bg-red-50 transition">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth

        </div>

    </div>  -->




</body>

</html>