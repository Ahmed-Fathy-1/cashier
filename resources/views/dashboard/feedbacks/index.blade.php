@extends('dashboard.layouts.master')

@section('title', 'Feedbacks')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Feedbacks
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li>
                    <a href="{{ route('homePage') }}"
                        class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                        Home >
                    </a>
                </li>
                <li>
                    <a> 
                        Feedbacks
                    </a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Feedback List
                </h4>
                <a href="{{ route('feedbacks.trashedFeedbacks') }}" class="btn bg-error text-white hover:bg-error-focus focus:bg-error-focus dark:bg-error dark:hover:bg-error-focus dark:focus:bg-error-focus mt-4">
                    View Deleted Feedbacks
                </a>
            </div>

            <div class="p-4 sm:p-5">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-navy-500">
                    <thead class="bg-slate-50 dark:bg-navy-600">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Feedback
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider dark:text-navy-200">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200 dark:bg-navy-700 dark:divide-navy-600">
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-navy-50">
                                    {{ $feedback->id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                    {{ $feedback->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                    {{ $feedback->email }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100">
                                    {{ $feedback->content }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 dark:text-navy-100 flex space-x-2"> 
                                    <!-- Delete Button with confirmation -->
                                    <button type="button" data-toggle="modal" data-target="#modal1" data-route="{{ route('feedbacks.destroy', $feedback->id) }}" onclick="setDeleteRoute(this)"
                                        class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>

                                    <!-- Modal Component for Delete Confirmation -->
                                    @component('dashboard.layouts.deletemodal', ['route' => route('feedbacks.destroy', $feedback->id)])
                                    @endcomponent
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                <ol class="pagination space-x-1.5">
                    {{ $feedbacks->links() }}
                </ol>
            </div>
        </div>
    </main>

    <script>
        function setDeleteRoute(button) {
            const route = button.getAttribute('data-route');
            const deleteForm = document.querySelector('#modal1 form');
            deleteForm.action = route;
        }
    </script>
@endsection
