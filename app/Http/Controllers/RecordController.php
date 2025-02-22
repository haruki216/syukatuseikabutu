<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


 



class RecordController extends Controller
{
    /**
     * カレンダー画面
     */
    public function index(Request $request)
    {
        $ym = $request->query('ym', date('Y-m'));
        $timestamp = strtotime($ym . '-01');

        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }

        $html_title = date('Y年n月', $timestamp);
        $prev = date('Y-m', strtotime('-1 month', $timestamp));
        $next = date('Y-m', strtotime('+1 month', $timestamp));
        $day_count = date('t', $timestamp);
        $youbi = date('w', $timestamp);

        $weeks = [];
        $week = str_repeat('<td></td>', $youbi);

        $user = Auth::user();
        $memos = Record::where('user_id', $user->id)->pluck('category', 'date')->all();

        for ($day = 1; $day <= $day_count; $day++, $youbi++) {
            $date = $ym . '-' . sprintf('%02d', $day);
            $link = '<a href="' . route('records.memo', ['date' => $date]) . '">' . $day . '</a>';
            $class = (date('Y-m-d') == $date) ? "class='today'" : '';

            if (isset($memos[$date])) {
                $link .= '<br><span style="font-size: 0.8em;">' . htmlspecialchars($memos[$date], ENT_QUOTES, 'UTF-8') . '</span>';
            }

            $week .= '<td ' . $class . '>' . $link . '</td>';

            if ($youbi % 7 == 6 || $day == $day_count) {
                if ($day == $day_count) {
                    $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
                }
                $weeks[] = '<tr>' . $week . '</tr>';
                $week = '';
            }
        }

        return view('records.index', compact('html_title', 'prev', 'next', 'weeks', 'ym'));
    }

    /**
     * メモ登録
     */
    public function memo(Request $request, $date)
    {
        $user = Auth::user();
        $memo = Record::firstOrNew(['date' => $date, 'user_id' => $user->id]);

        if ($request->isMethod('post')) {
            $memo->category = $request->input('category');
            $memo->count = $request->input('count');
            $memo->user_id = $user->id;
            $memo->save();

            return redirect()->route('records.index');
        }

        return view('records.memo', compact('date', 'memo'));
    }

    /**
     * グラフデータ取得
     */
    public function getGraphData(Request $request)
    {
        $month = $request->query('month', date('Y-m'));
        $user = Auth::user();

        $records = Record::where('user_id', $user->id)
            ->where('date', 'like', "{$month}%")
            ->selectRaw('category, SUM(count) as total_count')
            ->groupBy('category')
            ->get();

        $labels = $records->pluck('category');
        $data = $records->pluck('total_count');

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => '合計回数',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)'
                ]
            ]
        ]);
    }
}
