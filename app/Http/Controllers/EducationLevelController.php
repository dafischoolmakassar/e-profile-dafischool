<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\EducationLevel;
use App\Models\SchoolSetting;

class EducationLevelController extends Controller
{
    public function index()
    {
        $levels = EducationLevel::orderBy('order')->get();
        $setting = SchoolSetting::current();
        return view('levels.index', compact('levels', 'setting'));
    }

    public function show(EducationLevel $educationLevel)
    {
        $levels = EducationLevel::orderBy('order')->get(['id', 'name', 'slug']);
        $activeYearId = AcademicYear::active()->value('id');

        $educationLevel->load([
            'facilities' => fn ($query) => $query->where('academic_year_id', $activeYearId),
            'classStats' => fn ($query) => $query->where('academic_year_id', $activeYearId),
            'extracurriculars' => fn ($query) => $query->where('academic_year_id', $activeYearId),
            'activities' => fn ($query) => $query->where('academic_year_id', $activeYearId),
            'testimonials',
        ]);

        // Hide extracurriculars section for RTK unit (order=1)
        if ($educationLevel->order === 1) {
            $educationLevel->show_extracurriculars = false;
        }

        $isBoarding = $educationLevel->slug === 'boarding smpit-smait';
        $isInklusi = $educationLevel->slug === 'inklusi';
        $isSmait = $educationLevel->slug === 'smait';

        return view('levels.show', [
            'level' => $educationLevel,
            'allLevels' => $levels,
            'setting' => SchoolSetting::current(),
            'isBoarding' => $isBoarding,
            'isInklusi' => $isInklusi,
            'isSmait' => $isSmait,
        ]);
    }
}
