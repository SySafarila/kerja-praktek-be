<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PpdbControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->student) {
            return redirect()->route('ppdb.payment');
        }
        return view('ppdb');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student.nisn' => ['required', 'string', 'max:255'],
            'student.full_name' => ['required', 'string', 'max:255'],
            'student.gender' => ['required', 'string', 'in:male,female'],
            'student.birth_place' => ['required', 'string', 'max:255'],
            'student.birth_date' => ['required', 'date'],
            'student.religion' => ['required', 'string', 'max:255'],
            'student.address' => ['required', 'string'],
            'student.whatsapp' => ['required', 'string', 'max:255'],
            'student.email' => ['required', 'email', 'max:255'],
            'student.last_school' => ['required', 'string', 'max:255'],
            'student.org_experience' => ['string', 'nullable'],
            'student.height' => ['required', 'numeric'],
            'student.weight' => ['required', 'numeric'],
            'student.history_illness' => ['string', 'nullable'],
            'parent.full_name' => ['required', 'string', 'max:255'],
            'parent.gender' => ['required', 'string', 'in:male,female'],
            'parent.job' => ['required', 'string'],
            'parent.income_per_month' => ['required', 'numeric'],
            'parent.whatsapp' => ['required', 'string', 'max:255'],
            'parent.email' => ['required', 'email', 'max:255'],
            'payment_method' => ['required', 'string', 'in:qris,va_bca,va_bni,va_bri,va_permata,va_cimb,gopay,shopeepay,offline']
        ]);


        $student = $request->student;
        $parent = $request->parent;
        $payment_method = $request->payment_method;
        $user = Auth::user();
        DB::transaction(function() use ($user ,$student, $parent) {
            // registering student
            $create_student = $user->student()->create([
                'nisn' => $student['nisn'],
                'full_name' => $student['full_name'],
                'gender' => $student['gender'],
                'birth_place' => $student['birth_place'],
                'birth_date' => $student['birth_date'],
                'religion' => $student['religion'],
                'address' => $student['address'],
                'email' => $student['email'],
                'whatsapp' => $student['whatsapp'],
                'last_school' => $student['last_school'],
                'org_experience' => $student['org_experience'],
                'height' => $student['height'],
                'weight' => $student['weight'],
                'history_illness' => $student['history_illness'],
                'is_new' => true,
            ]);

            // registering student's parent
            $create_student->parent()->create([
                'full_name' => $parent['full_name'],
                'gender' => $parent['gender'],
                'job' => $parent['job'],
                'income_per_month' => $parent['income_per_month'],
                'whatsapp' => $parent['whatsapp'],
                'email' => $parent['email'],
            ]);

            // create transaction
            // $user->transaction()->create([

            // ])
        });
        return redirect()->route('ppdb.payment');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function payment() {
        $user = Auth::user();
        if (!$user->student) {
            return redirect()->route('ppdb.index');
        }
        $student = $user->student;
        return view('ppdb-payment', compact('student'));
    }
}
