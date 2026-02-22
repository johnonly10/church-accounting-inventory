@extends('layouts.guest')

@section('content')
    <x-hero-section title="About <em>Us</em>" :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'About Us']]" />

    <!-- About Content -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <section>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            Founded in 1987, {{ config('app.name') }} is a
                            Christ-centered
                            church family committed to loving God, loving people, and making disciples.
                        </p>
                        <p class="text-lg text-gray-600 mb-4">
                            We gather to worship Jesus, grow through God's Word, and encourage one another through authentic
                            community. Whether you're new to faith or have walked with Christ for years, you are welcome
                            here.
                        </p>
                        <p class="text-lg text-gray-600">
                            Our prayer is simple: that our city would know the hope of the gospel through worship,
                            discipleship,
                            and compassionate service.
                        </p>

                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="text-sm font-semibold text-gray-900">Worship</p>
                                <p class="text-sm text-gray-600">Gathering to exalt Jesus</p>
                            </div>
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="text-sm font-semibold text-gray-900">Discipleship</p>
                                <p class="text-sm text-gray-600">Growing in the Word</p>
                            </div>
                            <div class="rounded-xl border border-gray-200 p-4">
                                <p class="text-sm font-semibold text-gray-900">Outreach</p>
                                <p class="text-sm text-gray-600">Serving our community</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl p-8 h-96 flex items-center justify-center">
                        <svg class="w-64 h-64 text-blue-700" viewBox="0 0 64 64" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M32 10v44M20 22h24" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 54h28" />
                        </svg>
                    </div>
                </div>
            </section>

            <section>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-600 text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.536-6.536l-1.414 1.414M6.879 17.121l-1.414 1.414m12.071 0l-1.414-1.414M6.879 6.879 5.465 5.465M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Our Mission</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            To glorify God by making disciples of Jesus Christ—loving God wholeheartedly, loving people
                            genuinely, and reaching our community and the nations with the gospel.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex gap-2">
                                <span class="mt-2 h-2 w-2 rounded-full bg-blue-600"></span>
                                Worship Jesus and teach God's Word faithfully
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-2 h-2 w-2 rounded-full bg-blue-600"></span>
                                Build a caring church family through small groups and prayer
                            </li>
                            <li class="flex gap-2">
                                <span class="mt-2 h-2 w-2 rounded-full bg-blue-600"></span>
                                Serve our neighbors with compassion and generosity
                            </li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-600 text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Our Vision</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            To see lives transformed by Jesus, families restored, and our city renewed—raising up
                            Spirit-filled believers who live on mission wherever God sends them.
                        </p>
                        <div class="rounded-xl bg-white p-5 border border-gray-200">
                            <p class="text-sm font-semibold text-gray-900 mb-1">Vision in one sentence</p>
                            <p class="text-gray-600">
                                A gospel-shaped church that multiplies disciples, leaders, and ministries for the glory of
                                God.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Values Section -->
            <section>
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Values</h2>
                    <p class="text-xl text-gray-600">What shapes our worship, our community, and our mission</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 19.5A2.5 2.5 0 016.5 17H20M4 4.5A2.5 2.5 0 016.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Bible-Centered</h3>
                        <p class="text-gray-600">
                            We believe Scripture is God's Word and our foundation for faith, teaching, and daily living.
                        </p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Loving Community</h3>
                        <p class="text-gray-600">
                            We're a family—welcoming, growing, and walking together in grace, prayer, and encouragement.
                        </p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 11V6a2 2 0 114 0v5m-4 0V7a2 2 0 114 0v4m0 0V8a2 2 0 114 0v3m-4 0v-1a2 2 0 114 0v5a6 6 0 01-6 6h-2a6 6 0 01-6-6v-3a2 2 0 114 0v3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Mission & Service</h3>
                        <p class="text-gray-600">
                            We exist to share the hope of Jesus—serving our neighbors, our city, and the nations.
                        </p>
                    </div>
                </div>
            </section>

            <section>
                <div class="bg-gray-50 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">What We Believe</h3>
                    <p class="text-gray-600 mb-4">
                        We believe in one God—Father, Son, and Holy Spirit. We believe Jesus Christ is Lord, fully God and
                        fully
                        man, and that salvation is by grace through faith. We believe the church is called to worship,
                        disciple,
                        and live out the gospel in the power of the Spirit.
                    </p>
                    <a href="{{ route('contact.index') }}"
                        class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-800">
                        Have questions? Contact us
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </section>
        </div>
    </section>

    <!-- Team / Leadership Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Meet Our Leaders</h2>
                <p class="text-xl text-gray-600">Pastors and ministry leaders here to serve</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-32 h-32 rounded-full mx-auto mb-4">
                        <img src="{{ asset('Images/About/Matthew.jpg') }}" alt="Matthew Addangna"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Matthew Addangna</h3>
                    <p class="text-gray-600">Lead Pastor</p>
                </div>

                <div class="text-center">
                    <div class="w-32 h-32 rounded-full mx-auto mb-4">
                        <img src="{{ asset('Images/About/Teth.jpg') }}" alt="Teth Addangna"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Pastor Wife</h3>
                    <p class="text-gray-600">Teresita Addangna</p>
                </div>

                <div class="text-center">
                    <div class="w-32 h-32 rounded-full mx-auto mb-4">
                        <img src="{{ asset('Images/About/PJ.jpg') }}" alt="PJ Addangna"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">PJ Addangna</h3>
                    <p class="text-gray-600">Worship Leader</p>
                </div>

                <div class="text-center">
                    <div class="w-32 h-32 rounded-full mx-auto mb-4">
                        <img src="{{ asset('Images/About/Sheena.jpg') }}" alt="Sheena Cudimat"
                            class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Sheena Cudimat</h3>
                    <p class="text-gray-600">Youth / Kids Ministry</p>
                </div>
            </div>
        </div>
    </section>
@endsection
