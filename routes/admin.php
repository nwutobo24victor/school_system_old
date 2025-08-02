
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SuspensionController;

Route::middleware(['auth', 'role:admin'] )->group(function () {
    /////API
    Route::get('/generate/regnumber/{classes}', [StudentController::class, 'generateRegNumber']);
    //////////////////////


    //STUDENT
    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::post('/student', [StudentController::class, 'select_class'])->name('student.select_class');
    Route::get('/student/api', [StudentController::class, 'api'])->name('student.api');
    Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/student/add', [StudentController::class, 'create'])->name('student.add');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.add.store');
    Route::get('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::put('/student/update/{id}', [StudentController::class, 'update_store'])->name('student.update.store');
    Route::put('/student/update/passport/{id}', [StudentController::class, 'update_passport'])->name('student.passport.update.store');
    Route::put('/student/update/password/{id}', [StudentController::class, 'update_password'])->name('student.password.update.store');
    Route::get('/student/view/{id}', [StudentController::class, 'view'])->name('student.view');
    Route::put('/student/update/status/{id}', [StudentController::class, 'update_status'])->name('student.status.update.store');

    //PARENT
    Route::get('/parent', [GuardianController::class, 'index'])->name('parent');
    Route::get('/parent/api', [GuardianController::class, 'api'])->name('parent.api');
    Route::delete('/parent/{id}', [GuardianController::class, 'destroy'])->name('parent.destroy');
    Route::get('/parent/add', [GuardianController::class, 'create'])->name('parent.add');
    Route::post('/parent/store', [GuardianController::class, 'store'])->name('parent.add.store');
    Route::get('/parent/update/{id}', [GuardianController::class, 'update'])->name('parent.update');
    Route::put('/parent/update/{id}', [GuardianController::class, 'update_store'])->name('parent.update.store');
    Route::put('/parent/update/passport/{id}', [GuardianController::class, 'update_passport'])->name('parent.passport.update.store');
    Route::put('/parent/update/password/{id}', [GuardianController::class, 'update_password'])->name('parent.password.update.store');
    Route::get('/parent/view/{id}', [GuardianController::class, 'view'])->name('parent.view');
    Route::put('/parent/update/status/{id}', [GuardianController::class, 'update_status'])->name('parent.status.update.store');

    //TEACHER
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher');
    Route::get('/teacher/api', [TeacherController::class, 'api'])->name('teacher.api');
    Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    Route::get('/teacher/add', [TeacherController::class, 'create'])->name('teacher.add');
    Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.add.store');
    Route::get('/teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::put('/teacher/update/{id}', [TeacherController::class, 'update_store'])->name('teacher.update.store');
    Route::put('/teacher/update/passport/{id}', [TeacherController::class, 'update_passport'])->name('teacher.passport.update.store');
    Route::put('/teacher/update/password/{id}', [TeacherController::class, 'update_password'])->name('teacher.password.update.store');
    Route::get('/teacher/view/{id}', [TeacherController::class, 'view'])->name('teacher.view');
    Route::put('/teacher/update/status/{id}', [TeacherController::class, 'update_status'])->name('teacher.status.update.store');

    //STAFF
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
    Route::get('/staff/api', [StaffController::class, 'api'])->name('staff.api');
    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
    Route::get('/staff/add', [StaffController::class, 'create'])->name('staff.add');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.add.store');
    Route::get('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::put('/staff/update/{id}', [StaffController::class, 'update_store'])->name('staff.update.store');
    Route::put('/staff/update/passport/{id}', [StaffController::class, 'update_passport'])->name('staff.passport.update.store');
    Route::put('/staff/update/password/{id}', [StaffController::class, 'update_password'])->name('staff.password.update.store');
    Route::get('/staff/view/{id}', [StaffController::class, 'view'])->name('staff.view');
    Route::put('/staff/update/status/{id}', [StaffController::class, 'update_status'])->name('staff.status.update.store');

    //PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //CLASS
    Route::get('/class', [ClassesController::class, 'index'])->name('class');
    Route::get('/class/add', [ClassesController::class, 'create'])->name('class.add');
    Route::get('/class/update/{id}', [ClassesController::class, 'update'])->name('class.update');
    Route::post('/class/store', [ClassesController::class, 'store'])->name('class.add.store');
    Route::put('/class/update/{id}', [ClassesController::class, 'update_store'])->name('class.update.store');
    Route::delete('/class/{id}', [ClassesController::class, 'destroy'])->name('class.destroy');

    //DEPARTMENT
    Route::get('/department', [DepartmentController::class, 'index'])->name('department');
    Route::get('/department/add', [DepartmentController::class, 'create'])->name('department.add');
    Route::get('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.add.store');
    Route::put('/department/update/{id}', [DepartmentController::class, 'update_store'])->name('department.update.store');
    Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    //SECTION
    Route::get('/section', [SectionController::class, 'index'])->name('section');
    Route::get('/section/add', [SectionController::class, 'create'])->name('section.add');
    Route::get('/section/update/{id}', [SectionController::class, 'update'])->name('section.update');
    Route::post('/section/store', [SectionController::class, 'store'])->name('section.add.store');
    Route::put('/section/update/{id}', [SectionController::class, 'update_store'])->name('section.update.store');
    Route::delete('/section/{id}', [SectionController::class, 'destroy'])->name('section.destroy');

    //SUBJECT
    Route::get('/subject', [SubjectController::class, 'index'])->name('subject');
    Route::post('/subject', [SubjectController::class, 'select_class'])->name('subject.select_class');
    Route::get('/subject/add', [SubjectController::class, 'create'])->name('subject.add');
    Route::get('/subject/update/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::post('/subject/store', [SubjectController::class, 'store'])->name('subject.add.store');
    Route::put('/subject/update/{id}', [SubjectController::class, 'update_store'])->name('subject.update.store');
    Route::delete('/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');

    
    //SYLLABUS
    Route::get('/syllabus', [SyllabusController::class, 'index'])->name('syllabus');
    Route::post('/syllabus', [SyllabusController::class, 'select_class'])->name('syllabus.select_class');
    Route::get('/syllabus/add', [SyllabusController::class, 'create'])->name('syllabus.add');
    Route::get('/syllabus/update/{id}', [SyllabusController::class, 'update'])->name('syllabus.update');
    Route::post('/syllabus/store', [SyllabusController::class, 'store'])->name('syllabus.add.store');
    Route::put('/syllabus/update/{id}', [SyllabusController::class, 'update_store'])->name('syllabus.update.store');
    Route::put('/syllabus/update/passport/{id}', [SyllabusController::class, 'update_file'])->name('syllabus.syllabus_file.update.store');
    Route::delete('/syllabus/{id}', [SyllabusController::class, 'destroy'])->name('syllabus.destroy');

    //TIMETABLE
    Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable');
    Route::post('/timetable', [TimetableController::class, 'select_class'])->name('timetable.select_class');
    Route::get('/timetable/add', [TimetableController::class, 'create'])->name('timetable.add');
    Route::get('/timetable/update/{id}', [TimetableController::class, 'update'])->name('timetable.update');
    Route::post('/timetable/store', [TimetableController::class, 'store'])->name('timetable.add.store');
    Route::put('/timetable/update/{id}', [TimetableController::class, 'update_store'])->name('timetable.update.store');
    Route::put('/timetable/update/passport/{id}', [TimetableController::class, 'update_file'])->name('timetable.timetable_file.update.store');
    Route::delete('/timetable/{id}', [TimetableController::class, 'destroy'])->name('timetable.destroy');

    //ASSIGNMENT
    Route::get('/assignment', [AssignmentController::class, 'index'])->name('assignment');
    Route::post('/assignment', [AssignmentController::class, 'select_class'])->name('assignment.select_class');
    Route::get('/assignment/add', [AssignmentController::class, 'create'])->name('assignment.add');
    Route::get('/assignment/update/{id}', [AssignmentController::class, 'update'])->name('assignment.update');
    Route::post('/assignment/store', [AssignmentController::class, 'store'])->name('assignment.add.store');
    Route::put('/assignment/update/{id}', [AssignmentController::class, 'update_store'])->name('assignment.update.store');
    Route::put('/assignment/update/passport/{id}', [AssignmentController::class, 'update_file'])->name('assignment.assignment_file.update.store');
    Route::delete('/assignment/{id}', [AssignmentController::class, 'destroy'])->name('assignment.destroy');

    //SUSPENSION
    Route::get('/suspension', [SuspensionController::class, 'index'])->name('suspension');
    Route::get('/suspension/add', [SuspensionController::class, 'create'])->name('suspension.add');
    Route::get('/suspension/view/{id}', [SuspensionController::class, 'view'])->name('suspension.view');
    Route::get('/suspension/update/{id}', [SuspensionController::class, 'update'])->name('suspension.update');
    Route::post('/suspension/store', [SuspensionController::class, 'store'])->name('suspension.add.store');
    Route::put('/suspension/update/{id}', [SuspensionController::class, 'update_store'])->name('suspension.update.store');
    Route::delete('/suspension/{id}', [SuspensionController::class, 'destroy'])->name('suspension.destroy');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     //Route::get('/dashboard', [AdminController::class, 'index']);
// });

// Route::middleware(['auth', 'role:staff'])->group(function () {
//     //Route::get('/staff-panel', [StaffController::class, 'index']);
// });