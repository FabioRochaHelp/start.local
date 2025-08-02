<?php
use Illuminate\Support\Facades\DB;

if (!function_exists('confirm_delete_modal')) {
    function confirm_delete_modal($route, $message = 'Tem certeza que deseja excluir esse registro?')
    {
        return view('components.confirm_delete_modal', compact('route', 'message'))->render();
    }
}


if (!function_exists('confirm_result_negative')) {
    function confirm_result_negative($route, $message = 'Você está informando que esta cultura vem um resultado negativo para microorganimos. /n Deseja continuar?')    
    {
        return view('components.confirm_result_negative', compact('route', 'message'))->render();
    }
}

if (!function_exists('check_name_exists')) {
    function check_name_exists($table, $column, $value)
    {
        $exists = DB::table($table)->where($column, $value)->where('tenant_id', auth()->user()->tenant_id)->exists();

        if ($exists) {
            session()->flash('toast_message', 'Este nome já existe. Por favor, tente outro');
            session()->flash('toast_type', 'warning');
        }

        return $exists;
    }
}

if (!function_exists('formatarCelular')) {
    function formatarCelular($numero) {
        $numero = preg_replace('/[^0-9]/', '', $numero);
        if (strlen($numero) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $numero);
        }
        return $numero;
    }
}

if (!function_exists('formatarCPF')) {
    function formatarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
        }
        return $cpf;
    }
}

function formatarCNPJ($cnpj) {
    // Remove tudo que não for dígito
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    // Verifica se o CNPJ tem 14 dígitos
    if (strlen($cnpj) === 14) {
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }

    // Retorna o CNPJ original se não for válido
    return $cnpj;
}