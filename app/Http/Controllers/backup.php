
  // $searchMon = 'LTMT';
        // $searchLop = 'BKD01';
        // $subject = SubjectModel::where('Ma_nganh',$search)->where('Ma_monhoc',$searchMon)->orderBy('order')->get();
        $subject = SubjectModel::where('Ma_nganh',$search)->orderBy('order')->get();
        // $subject = SubjectModel::where('Hoc_ky',$searchKy)->where('Ma_nganh',$search)->orderBy('order')->get();

        // dd($subject);
        $students=StudentModel::with('subjects','class')
                // ->whereIn('Ma_lop',function($query) use ($search,$searchLop) {
                    ->whereIn('Ma_lop',function($query) use ($search) {
                    $query->select('Ma_lop');
                    $query->from('class_models');

                    $query->where('Ma_nganh',$search);
                    // $query->where('Ma_lop',$searchLop);

                })
                ->get();
        // $students=StudentModel::stdMon($search,$searchLop,$searchMon)->with('subjects','class');
        //    dd($students);
        foreach ($students as $key => $value) {
            $check = $value->subjects->count() == 0 ? true : false;
            if($check) {
                foreach ($subject as $key1 => $value1) { // LTMT
                    // if($value1->Ma_monhoc==$searchMon){
                    $mark = [
                        "Ma_SV" =>$value->Ma_SV,
                        "Ma_monhoc" => $value1->Ma_monhoc,
                        // "Hoc_ky" => 'x',
                        "Lan_thi" => '',
                        "Ly_thuyet" => '',
                        "Thuc_hanh" => ''
                    ];

                        $value1['pivot'] = $mark;
                    // }

                    $value->subjects->push($value1);
                }
            }else{
                $stdSubjects = $value->subjects;
                foreach ($subject as $key1 => $sub)  {
                    $checkInsert = true;
                    foreach ($stdSubjects as $key => $subSV){
                        // if($sub->Ma_monhoc==$searchMon){
                            $mark = [
                                "Ma_SV" =>$value->Ma_SV,
                                "Ma_monhoc" => $sub->Ma_monhoc,
                                // "Hoc_ky" => 'x',
                                "Lan_thi" => '',
                                "Ly_thuyet" => '',
                                "Thuc_hanh" => ''
                            ];

                                $sub['pivot'] = $mark;
                            // }

                        if($subSV->Ma_monhoc == $sub->Ma_monhoc) {
                            $checkInsert = false;
                            break;
                        }
                    }
                    if($checkInsert) {
                        $value->subjects->push($sub);
                    }
                }
            }
            // foreach ($value->subjects as $sub) {
            //     $value['Hoc_ky'] = $sub->pivot ? $sub->pivot['Hoc_ky'] : "x";
            // }
        }
        // Sắp xếp lại môn trong $students
        foreach ($students as $key => &$value) {
            $sorted = $value->subjects->sortBy('order');
            $key = $value->subjects->keys()->toArray();
            $value->subjects->forget($key);
            $sorted->each(function ($item, $key) use ($value) {
                $value->subjects->push($item);
            });
        }
        // dd($students->toArray());
        // $students = $students->toArray();
        $count=$subject->count();
        $data =['studentsList'=>$students,'count'=>$count,'subjectsList'=>$subject];
