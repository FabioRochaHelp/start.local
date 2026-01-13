<?php

namespace App\Http\Controllers;
use App\Models\CanalAtendimento;

use Illuminate\Http\Request;

class CanalAtendimentoController extends Controller
{
    public function current()
    {
        $canal = CanalAtendimento::first();
        
        if (!$canal) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum canal configurado'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $canal
        ]);
    }
    
    public function storeOrUpdate(Request $request)
    {

        //Mensagem personalizada validacao
        $messages = [
            'channelName.required' => 'O nome do canal é obrigatório.',
            'channelValue.required' => 'O valor do canal é obrigatório.',
            'tipo.required' => 'O tipo do canal é obrigatório.',
            'tipo.in' => 'O tipo do canal deve ser um dos seguintes: whatsapp, telegram, messenger, instagram, sms, email, outro.'
        ];

        $request->validate([
            'channelName' => 'required|string|max:255',
            'channelValue' => 'required|string|max:255',
            'tipo' => 'required|string|in:whatsapp,telegram,messenger,instagram,sms,email,outro',
            'ativo' => 'boolean'
        ], $messages);

        // Buscar ou criar canal
        $canal = CanalAtendimento::first();
        
        if (!$canal) {
            $canal = new CanalAtendimento();
        }
        
        // Atualizar dados
        $canal->fill($request->only(['channelName', 'channelValue', 'tipo', 'descricao', 'ativo']));
        $canal->save();
        
        return response()->json([
            'success' => true,
            'message' => $request->has('id') ? 'Canal atualizado com sucesso!' : 'Canal cadastrado com sucesso!',
            'data' => $canal
        ]);
    }
    
    public function destroy($id)
    {
        $canal = CanalAtendimento::findOrFail($id);
        $canal->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Canal removido com sucesso!'
        ]);
    }
}
