<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

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

    public function store(StoreUpdatePlan $request){
        $this->repository->create($request->all());
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

    public function update(StoreUpdatePlan $request, $url){
        $plan = $this->repository->where('url',$url)->first();

        if(!$plan)
            return redirect()->back();

        $plan->update($request->only(['name','price','description']));

        return redirect()->route('plans.index');
    }
}
