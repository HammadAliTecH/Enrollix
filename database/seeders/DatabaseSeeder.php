<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Payment_history;
use App\Models\Payment_plan;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Student;
use App\Models\Student_course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = collect([
            'student_managment',
            'course_managment',
            'users_managment',
            'privileges_managment',
            'finance_managment',
        ])->mapWithKeys(function (string $name) {
            return [$name => Permission::updateOrCreate(['name' => $name])];
        });

        $roles = collect(['super_admin', 'admin', 'hr', 'teacher'])
            ->mapWithKeys(function (string $name) {
                return [$name => Role::updateOrCreate(['name' => $name])];
            });

        $roles['super_admin']->permissions()->sync($permissions->pluck('id'));
        $roles['admin']->permissions()->sync([
            $permissions['student_managment']->id,
            $permissions['course_managment']->id,
            $permissions['finance_managment']->id,
        ]);
        $roles['hr']->permissions()->sync([
            $permissions['student_managment']->id,
            $permissions['finance_managment']->id,
        ]);
        $roles['teacher']->permissions()->sync($permissions['course_managment']->id);

        $admin = User::updateOrCreate(
            ['email' => 'admin@sms.test'],
            [
                'name' => 'SMS Administrator',
                'profile_img' => 'default.png',
                'password' => 'password',
            ]
        );
        $teacher = User::updateOrCreate(
            ['email' => 'teacher@sms.test'],
            [
                'name' => 'Bilal Ahmad',
                'profile_img' => 'default.png',
                'password' => 'password',
            ]
        );
        $admin->roles()->syncWithoutDetaching([$roles['admin']->id]);
        $teacher->roles()->syncWithoutDetaching([$roles['teacher']->id]);

        $courses = collect([
            [
                'name' => 'Laravel Development',
                'duration' => '3-MONTHS',
                'fee' => 45000,
                'payment_type' => 'INSTALLMENTS',
                'total_installments' => '3',
            ],
            [
                'name' => 'PHP and MySQL',
                'duration' => '2-MONTHS',
                'fee' => 30000,
                'payment_type' => 'ONE-TIME',
                'total_installments' => '1',
            ],
            [
                'name' => 'Full Stack Web Development',
                'duration' => '6-MONTHS',
                'fee' => 90000,
                'payment_type' => 'INSTALLMENTS',
                'total_installments' => '6',
            ],
        ])->mapWithKeys(function (array $courseData) use ($teacher) {
            $course = Course::updateOrCreate(
                ['name' => $courseData['name'], 'user_id' => $teacher->id],
                array_merge($courseData, [
                    'description' => 'Demo course for testing the student management workflow.',
                    'pdf_book' => 'demo-course.pdf',
                    'cover_image' => 'demo-course.jpg',
                    'user_id' => $teacher->id,
                ])
            );

            return [$course->name => $course];
        });

        $students = collect([
            [
                'name' => 'Ayesha Khan',
                'gender' => 'FEMALE',
                'age' => 21,
                'cnic_number' => '35202-1111111-1',
                'email' => 'ayesha.khan@sms.test',
            ],
            [
                'name' => 'Hamza Ali',
                'gender' => 'MALE',
                'age' => 23,
                'cnic_number' => '35202-2222222-2',
                'email' => 'hamza.ali@sms.test',
            ],
        ])->map(function (array $studentData) {
            return Student::updateOrCreate(
                ['email' => $studentData['email']],
                array_merge($studentData, [
                    'cnic_document' => 'demo-cnic.pdf',
                    'image' => 'default-student.png',
                    'father_name' => 'Demo Father',
                    'father_cnic' => '35202-3333333-3',
                    'father_occupation' => 'Business',
                    'contact_number' => '03001234567',
                    'father_cell_number' => '03007654321',
                    'address' => 'Shahkot, Punjab',
                    'recent_education' => 'MATRIC',
                    'marks' => '850/1100',
                    'enrolled_program' => 'Web Development',
                    'educational_place' => 'SMS Institute',
                ])
            );
        });

        $startingDate = Carbon::today()->subDays(10);
        $enrollments = [
            [$students[0], $courses['Laravel Development']],
            [$students[1], $courses['PHP and MySQL']],
        ];

        foreach ($enrollments as [$student, $course]) {
            $endingDate = $this->calculateEndingDate($startingDate, $course->duration);
            $enrollment = Student_course::updateOrCreate(
                ['student_id' => $student->id, 'course_id' => $course->id],
                [
                    'payment_map' => $course->payment_type,
                    'starting_date' => $startingDate,
                    'ending_date' => $endingDate,
                ]
            );

            $installmentCount = (int) $course->total_installments;
            $installmentFee = (int) ceil($course->fee / $installmentCount);

            for ($installment = 1; $installment <= $installmentCount; $installment++) {
                $paymentPlan = Payment_plan::updateOrCreate(
                    [
                        'student_course_id' => $enrollment->id,
                        'installment_no' => $installment,
                    ],
                    [
                        'plan_name' => $course->payment_type,
                        'total_installments' => $installmentCount,
                        'total_fee' => $course->fee,
                        'starting_date' => $startingDate,
                        'due_date' => $startingDate->copy()->addMonths($installment),
                        'fee_per_installment' => $installmentFee,
                        'status' => $installment === 1 ? 'paid' : 'pending',
                    ]
                );

                if ($installment === 1) {
                    Payment_history::updateOrCreate(
                        ['payment_plan_id' => $paymentPlan->id],
                        [
                            'pay_amount' => $installmentFee,
                            'payment_mode' => 'cash',
                            'pay_date' => $startingDate,
                            'user_id' => $admin->id,
                        ]
                    );
                }
            }
        }
    }

    private function calculateEndingDate(Carbon $startingDate, string $duration): Carbon
    {
        return match (strtoupper(trim($duration))) {
            '2-MONTHS' => $startingDate->copy()->addMonths(2),
            '3-MONTHS' => $startingDate->copy()->addMonths(3),
            '6-MONTHS' => $startingDate->copy()->addMonths(6),
            'ONE YEAR' => $startingDate->copy()->addYear(),
            default => $startingDate->copy(),
        };
    }
}
