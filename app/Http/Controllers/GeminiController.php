<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Str;

class GeminiController extends Controller
{
    //
    
     public function index(Request $request)
    {
        return view('AI.index');
    }
    
     public function entry(Request $request)
    {
         $toGeminiCommand = "# やって欲しいこと\n次のテキストを基にダイエット計画を立ててください。\n# 計画には、次の内容を含めてください。\n- 実施することを箇条書き\n- やるべきことのポイントや期間。改行も入れてください。\n- 食事できをつけるべきことなど\n```\n" . $request->toGeminiText . "\n```";

        $result = [
            'task' => $request->toGeminiText,
            'content' => Str::markdown(Gemini::geminiPro()->generateContent($toGeminiCommand)->text()),
        ];
        return view('AI.index', compact('result'));
    }
}
