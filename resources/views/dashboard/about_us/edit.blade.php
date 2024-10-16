@extends('dashboard.layouts.master')

@section('title', 'About Us')

@push('style')
@endpush

@section('main')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                About Us
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                       href="{{ route('homePage') }}">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>About Us</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            About Us Information
                        </h4>

                    </div>
                </div>
                <form action="{{ route('about_us.update', $aboutUs->id) }}" method="POST" enctype="multipart/form-data" id="about-form">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 p-4 sm:p-5">

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Sub Title</span>
                        </label>
                        <textarea id="sub_title" name="sub_title" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter subtitle">{{ $aboutUs->sub_title }}</textarea>
                        @error('sub_title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Description</span>
                        </label>
                        <textarea id="description" name="description" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter description">{{ $aboutUs->description }}</textarea>
                        @error('description')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Service Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'services_image-image-preview')" tabindex="-1" type="file" name="services_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>
                        @error('services_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Service Description 1</span>
                        </label>
                        <textarea id="service_1_desc" name="service_1_desc" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 1">{{ $aboutUs->service_1_desc }}</textarea>
                        @error('service_1_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Service Description 2</span>
                        </label>
                        <textarea id="service_2_desc" name="service_2_desc" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 2">{{ $aboutUs->service_2_desc }}</textarea>
                        @error('service_2_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Service Description 3</span>
                        </label>
                        <textarea id="service_3_desc" name="service_3_desc" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->service_3_desc }}</textarea>
                        @error('service_3_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Package Number Description</span>
                        </label>
                        <textarea id="packages_numbers_desc" name="packages_numbers_desc" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->packages_numbers_desc }}</textarea>
                        @error('packages_numbers_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Package Number</span>
                        </label>
                        <textarea id="packages_numbers_number" name="packages_numbers_number" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->packages_numbers_number }}</textarea>
                        @error('packages_numbers_number')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Client Number Description</span>
                        </label>
                        <textarea id="clients_numbers_desc" name="clients_numbers_desc" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->clients_numbers_desc }}</textarea>
                        @error('clients_numbers_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Client Number</span>
                        </label>
                        <textarea id="clients_numbers_number" name="clients_numbers_number" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->clients_numbers_number }}</textarea>
                        @error('clients_numbers_number')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Apps Number Description</span>
                        </label>
                        <textarea id="apps_numbers_desc	" name="apps_numbers_desc	" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->apps_numbers_desc	 }}</textarea>
                        @error('apps_numbers_desc')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Apps Number</span>
                        </label>
                        <textarea id="apps_numbers_number" name="apps_numbers_number" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->apps_numbers_number }}</textarea>
                        @error('apps_numbers_number')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Info 1</span>
                        </label>
                        <textarea id="info_1" name="info_1" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->info_1 }}</textarea>
                        @error('info_1')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Info 2</span>
                        </label>
                        <textarea id="info_2" name="info_2" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->info_2 }}</textarea>
                        @error('info_2')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Completeness</span>
                        </label>
                        <textarea id="completeness" name="completeness" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->completeness }}</textarea>
                        @error('completeness')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Control</span>
                        </label>
                        <textarea id="control" name="control" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->control }}</textarea>
                        @error('control')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Proficiency</span>
                        </label>
                        <textarea id="proficiency" name="proficiency" class="w-full h-48 border border-gray-300 rounded" placeholder="Enter service description 3">{{ $aboutUs->proficiency }}</textarea>
                        @error('proficiency')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Repeat similar blocks for other descriptions -->

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="btn bg-primary text-white hover:bg-primary-focus">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
