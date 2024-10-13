@extends('dashboard.layouts.master')

@section('title', 'create package')

@push('style')
@endpush

@section('main')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                AiTech
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
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('packages.index') }}">package List</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Store package</li>
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
                            package
                        </h4>

                    </div>
                </div>
                <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="space-y-4 p-4 sm:p-5">

                        <label class="block">
                            <span>title</span>

                            <input name="title"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter title" type="text">
                        </label>
                        @error('title')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>description</span>

                            <input name="description"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter description" type="text">
                        </label>
                        @error('description')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>What type of event is stutas?</span>
                            <select
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                name="active">
                                <option value="1">Active</option>
                                <option value="0">InActive</option>

                            </select>
                        </label>
                        @error('status')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


                        <label class="block">
                            <span>Price_annually</span>

                            <input name="Price_annually"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter Price_annually" type="text">
                        </label>
                        @error('Price_annually')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block">
                            <span>storage_monthly</span>

                            <input name="storage_monthly"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter storage_monthly" type="text">
                        </label>
                        @error('storage_monthly')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>storage_annually</span>

                            <input name="storage_annually"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter storage_annually" type="text">
                        </label>
                        @error('storage_annually')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror



                        <label class="block">
                            <span>interactive_archives</span>

                            <input name="interactive_archives"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter interactive_archives" type="text">
                        </label>
                        @error('interactive_archives')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block">
                            <span>custom_branding</span>

                            <input name="custom_branding"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter custom_branding" type="text">
                        </label>
                        @error('custom_branding')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block">
                            <span>messages</span>

                            <input name="messages"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter messages" type="text">
                        </label>
                        @error('messages')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <label class="block">
                            <span>notifications</span>

                            <input name="notifications"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter notifications" type="text">
                        </label>
                        @error('notifications')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>main_show</span>

                            <input name="main_show"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter main_show" type="text">
                        </label>
                        @error('main_show')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>main_search</span>

                            <input name="main_search"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter main_search" type="text">
                        </label>
                        @error('main_search')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <label class="block">
                            <span>statics</span>

                            <input name="statics"
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter statics" type="text">
                        </label>
                        @error('statics')
                            <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror


                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                class="btn space-x-2 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Store</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
@endsection

@push('scripts')

@endpush
