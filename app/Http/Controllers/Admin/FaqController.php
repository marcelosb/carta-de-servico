<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Exibe a página de editar as perguntas frequentes
     * 
     * @route dashboard/faq/edit  GET
     * @return Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize('view', Faq::class);

        $faq = Faq::getFaq();

        return view('admin.dashboard.faqs.edit', [
            'faq' => $faq
        ]);
    }

    /**
     * Realiza a alteração das perguntas frequentes
     * 
     * @route dashboard/faq/update  PUT
     * @param App\Http\Requests\FaqRequest  $request
     * @return Illuminate\Http\Response
     */
    public function update(FaqRequest $request)
    {
        $this->authorize('edit', Faq::class);

        $faq = Faq::where('id', '>', 0)->firstOrFail();
        $faq->fill($request->all());
        $faq->save();

        return redirect()->route('dashboard.faq.edit')
            ->with('status', 'Perguntas frequentes atualizadas com sucesso!');
    }
    
}
