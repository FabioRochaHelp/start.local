<?php

namespace App\Http\Controllers;

use App\Services\AteconsuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class AteconsuController extends Controller
{
    /**
     * @var AteconsuService
     */
    private $ateconsuService;

    /**
     * Construtor
     *
     * @param AteconsuService $ateconsuService
     */
    public function __construct(AteconsuService $ateconsuService)
    {
        $this->ateconsuService = $ateconsuService;
    }

    /**
     * Exibe a view principal de consultas
     *
     * @return View
     */
    public function index(): View
    {
        return view('ateconsu.index');
    }

    /**
     * Exibe a lista de consultas com paginação
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function list(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $offset = $request->input('offset', 0);

            $result = $this->ateconsuService->getAllConsultas(
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

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $pagination = $result['success'] ? ($result['pagination'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Erro desconhecido');

            return view('ateconsu.list', compact('consultas', 'pagination', 'error'));

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.list', [
                'consultas' => [],
                'pagination' => [],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Obtém o total de consultas
     *
     * @return JsonResponse
     */
    public function count(): JsonResponse
    {
        try {
            $result = $this->ateconsuService->getCount();

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
     * Busca consultas por número
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

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Número é obrigatório',
                    'searchType' => 'numero',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultaByNumero((int) $numero);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'numero'))
                ->with('searchType', 'numero')
                ->with('searchValue', $numero);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'numero',
                'searchValue' => $numero ?? ''
            ]);
        }
    }

    /**
     * Busca consultas por nome
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

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Nome é obrigatório',
                    'searchType' => 'nome',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultasByNome($nome);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'nome'))
                ->with('searchType', 'nome')
                ->with('searchValue', $nome);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'nome',
                'searchValue' => $nome ?? ''
            ]);
        }
    }

    /**
     * Busca consultas por tipo
     *
     * @param Request $request
     * @param string|null $tipo
     * @return View|JsonResponse
     */
    public function searchByTipo(Request $request, string $tipo = null)
    {
        try {
            $tipo = $tipo ?? $request->input('tipo');

            if (empty($tipo)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Tipo é obrigatório'
                    ], 400);
                }

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Tipo é obrigatório',
                    'searchType' => 'tipo',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultasByTipo($tipo);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'tipo'))
                ->with('searchType', 'tipo')
                ->with('searchValue', $tipo);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'tipo',
                'searchValue' => $tipo ?? ''
            ]);
        }
    }

    /**
     * Busca consultas por situação
     *
     * @param Request $request
     * @param string|null $situacao
     * @return View|JsonResponse
     */
    public function searchBySituacao(Request $request, string $situacao = null)
    {
        try {
            $situacao = $situacao ?? $request->input('situacao');

            if (empty($situacao)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Situação é obrigatória'
                    ], 400);
                }

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Situação é obrigatória',
                    'searchType' => 'situacao',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultasBySituacao($situacao);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'situacao'))
                ->with('searchType', 'situacao')
                ->with('searchValue', $situacao);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'situacao',
                'searchValue' => $situacao ?? ''
            ]);
        }
    }

    /**
     * Busca consultas por especialidade
     *
     * @param Request $request
     * @param int|null $especialidade
     * @return View|JsonResponse
     */
    public function searchByEspecialidade(Request $request, int $especialidade = null)
    {
        try {
            $especialidade = $especialidade ?? $request->input('especialidade');

            if (empty($especialidade)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Especialidade é obrigatória'
                    ], 400);
                }

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Especialidade é obrigatória',
                    'searchType' => 'especialidade',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultasByEspecialidade((int) $especialidade);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'especialidade'))
                ->with('searchType', 'especialidade')
                ->with('searchValue', $especialidade);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'especialidade',
                'searchValue' => $especialidade ?? ''
            ]);
        }
    }

    /**
     * Busca consultas por médico
     *
     * @param Request $request
     * @param int|null $medico
     * @return View|JsonResponse
     */
    public function searchByMedico(Request $request, int $medico = null)
    {
        try {
            $medico = $medico ?? $request->input('medico');

            if (empty($medico)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Médico é obrigatório'
                    ], 400);
                }

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Médico é obrigatório',
                    'searchType' => 'medico',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultasByMedico((int) $medico);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'medico'))
                ->with('searchType', 'medico')
                ->with('searchValue', $medico);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'medico',
                'searchValue' => $medico ?? ''
            ]);
        }
    }

    /**
     * Busca consultas por setor
     *
     * @param Request $request
     * @param int|null $setor
     * @return View|JsonResponse
     */
    public function searchBySetor(Request $request, int $setor = null)
    {
        try {
            $setor = $setor ?? $request->input('setor');

            if (empty($setor)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Setor é obrigatório'
                    ], 400);
                }

                return view('ateconsu.search', [
                    'consultas' => [],
                    'error' => 'Setor é obrigatório',
                    'searchType' => 'setor',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateconsuService->getConsultasBySetor((int) $setor);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $consultas = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhuma consulta encontrada');

            return view('ateconsu.search', compact('consultas', 'error', 'setor'))
                ->with('searchType', 'setor')
                ->with('searchValue', $setor);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateconsu.search', [
                'consultas' => [],
                'error' => $e->getMessage(),
                'searchType' => 'setor',
                'searchValue' => $setor ?? ''
            ]);
        }
    }

    /**
     * Exibe formulário para criar nova consulta
     *
     * @return View
     */
    public function create(): View
    {
        return view('ateconsu.create');
    }

    /**
     * Salva uma nova consulta
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $consulta = $request->except(['_token']);

            $result = $this->ateconsuService->createConsulta($consulta);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 201);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('ateconsu.list')
                    ->with('toast_message', 'Consulta criada com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return back()
                    ->withInput()
                    ->with('toast_message', $result['error'] ?? 'Erro ao criar consulta')
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
                ->with('toast_message', 'Erro ao criar consulta: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Exibe formulário para editar consulta
     *
     * @param int $numero
     * @return View
     */
    public function edit(int $numero): View
    {
        $result = $this->ateconsuService->getConsultaByNumero($numero);

        if (!$result['success'] || empty($result['data'])) {
            return redirect()->route('ateconsu.list')
                ->with('toast_message', 'Consulta não encontrada')
                ->with('toast_type', 'error');
        }

        $consulta = is_array($result['data']) && isset($result['data'][0]) 
            ? $result['data'][0] 
            : $result['data'];

        return view('ateconsu.edit', compact('consulta'));
    }

    /**
     * Atualiza uma consulta existente
     *
     * @param Request $request
     * @param int $numero
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, int $numero)
    {
        try {
            $consulta = $request->except(['_token', '_method']);

            $result = $this->ateconsuService->updateConsulta($numero, $consulta);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('ateconsu.list')
                    ->with('toast_message', 'Consulta atualizada com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return back()
                    ->withInput()
                    ->with('toast_message', $result['error'] ?? 'Erro ao atualizar consulta')
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
                ->with('toast_message', 'Erro ao atualizar consulta: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Remove uma consulta
     *
     * @param Request $request
     * @param int $numero
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Request $request, int $numero)
    {
        try {
            $result = $this->ateconsuService->deleteConsulta($numero);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('ateconsu.list')
                    ->with('toast_message', 'Consulta removida com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return redirect()->route('ateconsu.list')
                    ->with('toast_message', $result['error'] ?? 'Erro ao remover consulta')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('ateconsu.list')
                ->with('toast_message', 'Erro ao remover consulta: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Exibe detalhes de uma consulta
     *
     * @param int $numero
     * @return View
     */
    public function show(int $numero): View
    {
        $result = $this->ateconsuService->getConsultaByNumero($numero);

        $consulta = null;
        $error = null;

        if ($result['success'] && !empty($result['data'])) {
            $consulta = is_array($result['data']) && isset($result['data'][0]) 
                ? $result['data'][0] 
                : $result['data'];
        } else {
            $error = $result['error'] ?? 'Consulta não encontrada';
        }

        return view('ateconsu.detail', compact('consulta', 'error'));
    }
}

