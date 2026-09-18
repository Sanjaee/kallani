<?php

namespace App\Http\Controllers;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = config('data.projects');
        return view('pages.explore', ['projects' => $projects]);
    }

    public function show($id)
    {
        $project = $this->getProject($id);
        $overview = config('data.overview');
        return view('pages.project.overview', compact('project', 'overview'));
    }

    public function asset($id)
    {
        $project = $this->getProject($id);
        $asset = config('data.asset');
        $parcels = config('data.parcels');
        return view('pages.project.asset', compact('project', 'asset', 'parcels'));
    }

    public function operations($id)
    {
        $project = $this->getProject($id);
        $operations = config('data.operations');
        return view('pages.project.operations', compact('project', 'operations'));
    }

    public function verification($id)
    {
        $project = $this->getProject($id);
        $verification = config('data.verification');
        return view('pages.project.verification', compact('project', 'verification'));
    }

    public function capital($id)
    {
        $project = $this->getProject($id);
        $capital = config('data.capital');
        return view('pages.project.capital', compact('project', 'capital'));
    }

    public function distribution($id)
    {
        $project = $this->getProject($id);
        $distribution = config('data.distribution');
        return view('pages.project.distribution', compact('project', 'distribution'));
    }

    public function esg($id)
    {
        $project = $this->getProject($id);
        $esg = config('data.esg');
        return view('pages.project.esg', compact('project', 'esg'));
    }

    public function documents($id)
    {
        $project = $this->getProject($id);
        $documents = config('data.documents');
        return view('pages.project.documents', compact('project', 'documents'));
    }

    public function audit($id)
    {
        $project = $this->getProject($id);
        $audit = config('data.audit');
        return view('pages.project.audit', compact('project', 'audit'));
    }

    private function getProject($id)
    {
        return config('data.projects')[0];
    }
}

class Controller
{
}
