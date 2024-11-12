<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateReceive;
use App\Models\ExamSession;
use App\Models\ExamUserAnswer;
use App\Models\ExamUserSession;
use App\Models\InformationService;
use App\Models\User;
use App\Models\UserHealthContribution;
use App\Models\UserInitialPayment;
use App\Models\UserKemahasiswaanContribution;
use App\Models\UserLibraryContribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamUserSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_exams = ExamUserSession::orderBy('id', 'desc')->paginate(10);
        return view('admin.exam_user_sessions.index', compact('user_exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $exam_sessions = ExamSession::select('id', 'name')->get();
        return view('admin.exam_user_sessions.create', compact('users', 'exam_sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'exam_session_id' => 'required|exists:exam_sessions,id'
        ]);
        ExamUserSession::create($data);
        return redirect()->route('exam_user_sessions.index')->with('berhasil membuat session');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_exam = ExamUserSession::find($id);
        $exam = User::find($user_exam->user_id)->user_information?->registration_path?->exam_registration_path?->exam;
        return view('admin.exam_user_sessions.show', compact('user_exam', 'exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user_exam = ExamUserSession::find($id);
        $user_exam->update($data);

        $certificate_receive['user_id'] = $user_exam->user_id;
        CertificateReceive::create($certificate_receive);
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam_user_session = ExamUserSession::find($id);
        $exam_user_session->delete();
        return redirect()->back()->with('success', 'Data berhasil di hapus');
    }
}
