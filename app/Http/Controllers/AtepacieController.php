<?php

namespace App\Http\Controllers;

use App\Services\AtepacieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class AtepacieController extends Controller
{
    /**
     * @var AtepacieService
     */
    private $atepacieService;

    /**
     * Construtor
     *
     * @param AtepacieService $atepacieService
     */
    public function __construct(AtepacieService $atepacieService)
    {
        $this->atepacieService = $atepacieService;
    }

    /**
     * Exibe a view principal de pacientes
     *
     * @return View
     */
    public function index(): View
    {
        return view('atepacie.index');
    }

    /**
     * Exibe a lista de pacientes com paginação
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function list(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $offset = $request->input('offset', 0);

            $result = $this->atepacieService->getAllPacientes(
                (int) $limit,
                (int) $offset
            );

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $pagination = $result['success'] ? ($result['pagination'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Erro desconhecido');

            return view('atepacie.list', compact('pacientes', 'pagination', 'error'));

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('atepacie.list', [
                'pacientes' => [],
                'pagination' => [],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Obtém o total de pacientes
     *
     * @return JsonResponse
     */
    public function count(): JsonResponse
    {
        try {
            $result = $this->atepacieService->getCount();

            if ($result['success']) {
                return response()->json($result, 200);
            } else {
                return response()->json($result, 400);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Busca pacientes por número
     *
     * @param Request $request
     * @param int|null $numero
     * @return View|JsonResponse
     */
    public function searchByNumero(Request $request, int $numero = null)
    {
        try {
            $numero = $numero ?? $request->input('numero');

            if (empty($numero)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Número é obrigatório'
                    ], 400);
                }

                return view('atepacie.search', [
                    'pacientes' => [],
                    'error' => 'Número é obrigatório',
                    'searchType' => 'numero',
                    'searchValue' => ''
                ]);
            }

            $result = $this->atepacieService->getPacienteByNumero((int) $numero);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum paciente encontrado');

            return view('atepacie.search', compact('pacientes', 'error', 'numero'))
                ->with('searchType', 'numero')
                ->with('searchValue', $numero);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('atepacie.search', [
                'pacientes' => [],
                'error' => $e->getMessage(),
                'searchType' => 'numero',
                'searchValue' => $numero ?? ''
            ]);
        }
    }

    /**
     * Busca pacientes por CPF
     *
     * @param Request $request
     * @param string|null $cpf
     * @return View|JsonResponse
     */
    public function searchByCpf(Request $request, string $cpf = null)
    {
        try {
            $cpf = $cpf ?? $request->input('cpf');

            if (empty($cpf)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'CPF é obrigatório'
                    ], 400);
                }

                return view('atepacie.search', [
                    'pacientes' => [],
                    'error' => 'CPF é obrigatório',
                    'searchType' => 'cpf',
                    'searchValue' => ''
                ]);
            }

            $result = $this->atepacieService->getPacienteByCpf($cpf);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum paciente encontrado');

            return view('atepacie.search', compact('pacientes', 'error', 'cpf'))
                ->with('searchType', 'cpf')
                ->with('searchValue', $cpf);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('atepacie.search', [
                'pacientes' => [],
                'error' => $e->getMessage(),
                'searchType' => 'cpf',
                'searchValue' => $cpf ?? ''
            ]);
        }
    }

    /**
     * Busca pacientes por documento
     *
     * @param Request $request
     * @param string|null $documento
     * @return View|JsonResponse
     */
    public function searchByDocumento(Request $request, string $documento = null)
    {
        try {
            $documento = $documento ?? $request->input('documento');

            if (empty($documento)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Documento é obrigatório'
                    ], 400);
                }

                return view('atepacie.search', [
                    'pacientes' => [],
                    'error' => 'Documento é obrigatório',
                    'searchType' => 'documento',
                    'searchValue' => ''
                ]);
            }

            $result = $this->atepacieService->getPacienteByDocumento($documento);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum paciente encontrado');

            return view('atepacie.search', compact('pacientes', 'error', 'documento'))
                ->with('searchType', 'documento')
                ->with('searchValue', $documento);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('atepacie.search', [
                'pacientes' => [],
                'error' => $e->getMessage(),
                'searchType' => 'documento',
                'searchValue' => $documento ?? ''
            ]);
        }
    }

    /**
     * Busca pacientes por nome
     *
     * @param Request $request
     * @param string|null $nome
     * @return View|JsonResponse
     */
    public function searchByNome(Request $request, string $nome = null)
    {
        try {
            $nome = $nome ?? $request->input('nome');

            if (empty($nome)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Nome é obrigatório'
                    ], 400);
                }

                return view('atepacie.search', [
                    'pacientes' => [],
                    'error' => 'Nome é obrigatório',
                    'searchType' => 'nome',
                    'searchValue' => ''
                ]);
            }

            $result = $this->atepacieService->getPacienteByNome($nome);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum paciente encontrado');

            return view('atepacie.search', compact('pacientes', 'error', 'nome'))
                ->with('searchType', 'nome')
                ->with('searchValue', $nome);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('atepacie.search', [
                'pacientes' => [],
                'error' => $e->getMessage(),
                'searchType' => 'nome',
                'searchValue' => $nome ?? ''
            ]);
        }
    }

    /**
     * Exibe formulário para criar novo paciente
     *
     * @return View
     */
    public function create(): View
    {
        return view('atepacie.create');
    }

    /**
     * Salva um novo paciente
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $paciente = $request->except(['_token']);

            $result = $this->atepacieService->createPaciente($paciente);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 201);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('atepacie.list')
                    ->with('toast_message', 'Paciente criado com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return back()
                    ->withInput()
                    ->with('toast_message', $result['error'] ?? 'Erro ao criar paciente')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('toast_message', 'Erro ao criar paciente: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Exibe formulário para editar paciente
     *
     * @param int $numero
     * @return View
     */
    public function edit(int $numero): View
    {
        $result = $this->atepacieService->getPacienteByNumero($numero);

        if (!$result['success'] || empty($result['data'])) {
            return redirect()->route('atepacie.list')
                ->with('toast_message', 'Paciente não encontrado')
                ->with('toast_type', 'error');
        }

        $paciente = is_array($result['data']) && isset($result['data'][0]) 
            ? $result['data'][0] 
            : $result['data'];

        return view('atepacie.edit', compact('paciente'));
    }

    /**
     * Atualiza um paciente existente
     *
     * @param Request $request
     * @param int $numero
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, int $numero)
    {
        try {
            $paciente = $request->except(['_token', '_method']);

            $result = $this->atepacieService->updatePaciente($numero, $paciente);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('atepacie.list')
                    ->with('toast_message', 'Paciente atualizado com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return back()
                    ->withInput()
                    ->with('toast_message', $result['error'] ?? 'Erro ao atualizar paciente')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('toast_message', 'Erro ao atualizar paciente: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Remove um paciente
     *
     * @param Request $request
     * @param int $numero
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Request $request, int $numero)
    {
        try {
            $result = $this->atepacieService->deletePaciente($numero);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('atepacie.list')
                    ->with('toast_message', 'Paciente removido com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return redirect()->route('atepacie.list')
                    ->with('toast_message', $result['error'] ?? 'Erro ao remover paciente')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('atepacie.list')
                ->with('toast_message', 'Erro ao remover paciente: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Exibe detalhes de um paciente
     *
     * @param int $numero
     * @return View
     */
    public function show(int $numero): View
    {
        $result = $this->atepacieService->getPacienteByNumero($numero);

        $paciente = null;
        $error = null;

        if ($result['success'] && !empty($result['data'])) {
            $paciente = is_array($result['data']) && isset($result['data'][0]) 
                ? $result['data'][0] 
                : $result['data'];
        } else {
            $error = $result['error'] ?? 'Paciente não encontrado';
        }

        return view('atepacie.detail', compact('paciente', 'error'));
    }
}

