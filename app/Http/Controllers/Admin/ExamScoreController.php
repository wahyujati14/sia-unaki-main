<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamScore;
use Illuminate\Http\Request;

class ExamScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = ExamScore::whereType('AKADEMIK')->orderBy('id')->paginate(10);
        $non_scores = ExamScore::whereType('NON_AKADEMIK')->orderBy('id')->paginate(10);
        return view('admin.scores.index', compact('scores', 'non_scores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.scores.create');
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
            'name' => 'required|string',
            'start_score' => 'sometimes|integer',
            'end_score' => 'sometimes|integer',
            'type' => 'required',
        ]);
        if(request()->type == 'NON_AKADEMIK'){
            $data['start_score'] = 0;
            $data['end_score'] = 0;
        }
        ExamScore::create($data);
        return redirect()->route('exam_scores.index')->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $score = ExamScore::find($id);
        return view('admin.scores.edit', compact('score'));
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
        $this->validate($request, [
            'name' => 'sometimes|string',
            'start_score' => 'sometimes|integer',
            'end_score' => 'sometimes|integer',
        ]);
        $score = ExamScore::find($id);
        $data = $request->all();
        $score->update($data);
        return redirect()->route('exam_scores.index')->with('success', 'Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $score = ExamScore::find($id);
        $score->delete();
        return redirect()->back()->with('success', 'Data berhasil di hapus');
    }
}
