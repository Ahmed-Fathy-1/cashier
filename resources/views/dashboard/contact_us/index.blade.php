@extends('dashboard.layouts.master')

@section('title', 'Contact Us')

@push('style')
    <script src="{{ asset('SuperAdmin/assets/js/pages/components-modal.js') }}" defer=""></script>
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
                <li>Contact Us Entries</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
            <div id="table-filter">
                <div class="ac js-enabled" id="ac-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Contact Us Entries
                        </h2>
                    </div>
                    <div class="card mt-3">
                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                            <table class="is-hoverable w-full text-left">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            #
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Name
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Email
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Phone
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $index => $contact)
                                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $index + 1 }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $contact->name }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $contact->email }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                {{ $contact->phone ?? 'N/A' }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                <div class="flex space-x-2">
                                                    <!-- View Button -->
                                                    <a href="{{ route('contact-us.show', $contact->id) }}" class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#modal1"
                                                    class="mx-2 btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90 btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                                    <i class="fa fa-trash-alt"></i></button>

                                                    <!-- Delete Button -->

                                                    @component('dashboard.layouts.deletemodal', ['route' => route('contact-us.destroy', $contact->id)])
                                                    @endcomponent
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                            <ol class="pagination space-x-1.5">
                                {{ $contacts->links() }}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
