<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{

    private $repository;

    public function __construct(Plan $plan){
        $this->repository = $plan;
    }

    public function index(Request $request){

        $filters = $request->except('_token');

        $plans = $this->repository->sortable()->orderBy('id', 'desc')->paginate();

        return view('admin.pages.plans.index',compact('plans','filters'));
    }

    public function create(){
        return view('admin.pages.plans.create');
    }

    public function store(Request $request){
        $data = $request->all();
        $data['url'] = Str::slug($request->name);
        $this->repository->create($data);
        return redirect()->route('plans.index');
    }

    public function show($url){
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    public function destroy($url){
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan)
            return redirect()->back();

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request){

        $filters = $request->except('_token');
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index',compact('plans','filters'));
    }

    public function edit($url){
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit',[
            'plan' => $plan
        ]);
    }

    public function update(Request $request, $url){
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan)
            return redirect()->back();

        $plan['url'] = str::slug($request->name);
        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
