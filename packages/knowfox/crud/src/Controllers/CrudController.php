<?php

namespace Knowfox\Crud\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest as Request;

class CrudController extends Controller
{
    protected $setup;
    protected $context = null;

    private function stripPrefix($text)
    {
        return preg_replace('/^\S* /', '', $text);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_by = preg_split('/\|/', $this->setup->order_by);
        if (count($order_by) > 1) {
            $entities = $this->setup->model::orderBy($order_by[0], $order_by[1]);
        }
        else {
            $entities = $this->setup->model::orderBy($order_by[0], 'asc');
        }

        if (!empty($this->setup->with)) {
            $entities->with($this->setup->with);
        }

        $breadcrumbs = [
            route('home') => 'Start',
        ];
        if (!empty($this->setup->is_admin) && $this->setup->is_admin) {
            $breadcrumbs['#'] = 'Verwaltung';
        }

        $page_title = $this->setup->entity_title[1];
        $breadcrumbs['#index'] = $page_title;

        return view($this->setup->entity_name . '.index', [
            'page_title' => $page_title,
            'entity_name' => $this->setup->entity_name,
            'create' => [
                'route' => route($this->setup->entity_name . '.create'),
                'title' => 'Neue' . $this->setup->entity_title[0],
            ],
            'deletes' => !empty($this->setup->deletes) && $this->setup->deletes,
            'no_result' => 'Keine ' . $this->setup->entity_title[1],
            'columns' => $this->setup->columns,
            'entities' => $entities->paginate(),
            'context' => $this->context,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCrud($entity = null)
    {
        $breadcrumbs = [
            route('home') => 'Start',
        ];
        if (!empty($this->setup->is_admin) && $this->setup->is_admin) {
            $breadcrumbs['#'] = 'Verwaltung';
        }

        $breadcrumbs[route($this->setup->entity_name . '.index')] = $this->setup->entity_title[1];

        $page_title = 'Neue' . $this->setup->entity_title[0];
        $breadcrumbs['#create'] = $page_title;
        
        return view($this->setup->entity_name . '.create', [
            'page_title' => $page_title,
            'entity_name' => $this->setup->entity_name,
            'model' => $this->setup->model,
            'fields' => $this->setup->fields,
            'entity' => $entity,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    protected function withDefaults($input)
    {
        foreach ($this->setup->fields as $key => $info) {
            if (empty($input[$key]) && isset($this->setup->fields[$key]['default'])) {
                $input[$key] = $this->setup->fields[$key]['default'];
            }
        }
        return $input;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function storeCrud(Request $request)
    {
        return [
            $this->setup->model::create(
                $this->withDefaults($request->all())
            ),
            response()->redirectToRoute($this->setup->entity_name . '.create')
                ->with('status', 'Neue' . $this->setup->entity_title[0] . ' angelegt')
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function editCrud(Model $entity, $options = [])
    {
        $breadcrumbs = [
            route('home') => 'Start',
        ];
        if (!empty($this->setup->is_admin) && $this->setup->is_admin) {
            $breadcrumbs['#'] = 'Verwaltung';
        }

        $breadcrumbs[route($this->setup->entity_name . '.index')] = $this->setup->entity_title[1];

        $page_title = $this->stripPrefix($this->setup->entity_title[0])
            . ' ' . (!empty($options['verb']) ? $options['verb'] : 'bearbeiten');
        $breadcrumbs['#edit'] = $page_title;

        return view($this->setup->entity_name . '.edit', [
            'page_title' => $page_title,
            'entity_name' => $this->setup->entity_name,
            'fields' => $this->setup->fields,
            'entity' => $entity,
            'action' => !empty($options['action']) ? $options['action'] : null,
            'button' => !empty($options['button']) ? $options['button'] : null,
            'breadcrumbs' => $breadcrumbs,
            'bottom' => !empty($options['bottom']) ? $options['bottom'] : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function updateCrud(Request $request, Model $entity)
    {
        $entity->update(
            $this->withDefaults($request->all())
        );
        return response()->redirectToRoute($this->setup->entity_name . '.index')
            ->with('status', 'Änderungen an ' . $this->stripPrefix($this->setup->entity_title[0]) . ' gespeichert');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroyCrud(Model $entity)
    {
        $entity->delete();
        return response()->redirectToRoute($this->setup->entity_name . '.index')
            ->with('status', $this->stripPrefix($this->setup->entity_title[0]) . ' gelöscht');
    }
}