<?php

namespace App\Http\Controllers\SuperAdmin\FeedBacks;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\FeedbackRequest;
use App\Models\SuperAdmin\FeedBack;
use Request;

class FeedBacksController extends Controller
{
    
    public function index()
    {
        $feedbacks = FeedBack::all();
        return view('dashboard.feedbacks.index', data: ['feedbacks' => $feedbacks]);
    }

    public function create(FeedbackRequest $request)
    {
        $data = $request->validated();

        FeedBack::create($data);

        return view('/');

    }
    public function destroy($id)
    {
        $feedback = FeedBack::findOrFail($id);
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully');
    }


    public function trashedFeedbacks()
    {
        $feedbacks = FeedBack::onlyTrashed()->get();

        return view('dashboard.feedbacks.deleted', ['feedbacks' => $feedbacks]);
    }

    public function restore($id)
    {
        $product = FeedBack::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback restored successfully');
    }

    public function forceDelete($id)
    {
        $feedback = Feedback::withTrashed()->find($id);
        $feedback->forceDelete();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback permanent deleted successfully');
    }


}
