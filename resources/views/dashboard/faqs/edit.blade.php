@extends('dashboard.layouts.master')

@section('title', 'Edit FAQ')

@section('main')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Edit FAQ
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li>
                    <a href="{{ route('faqs.index') }}"
                        class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                        FAQs
                    </a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Edit FAQ Details
                </h4>
            </div>

            <div class="p-4 sm:p-5">
                <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="question" class="block text-sm font-medium text-slate-700 dark:text-navy-100">Question</label>
                        <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:bg-navy-700 dark:border-navy-600" required>
                    </div>

                    <div class="mb-4">
                        <label for="answer" class="block text-sm font-medium text-slate-700 dark:text-navy-100">Answer</label>
                        <textarea name="answer" id="answer" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary dark:bg-navy-700 dark:border-navy-600" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('faqs.index') }}" class="btn bg-gray-500 text-white hover:bg-gray-600 focus:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:bg-gray-800 mr-2">Cancel</a>
                        <button type="submit" class="btn bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus dark:bg-primary dark:hover:bg-primary-focus dark:focus:bg-primary-focus">Update FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
