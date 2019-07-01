<?php

namespace Flawless\Agenda\Http\Controllers\Admin;

use Flawless\Agenda\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Http\Requests\Admin\StoreGroupsRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateGroupsRequest;

class GroupsController extends Controller
{

  /**
   * Contains route related configuration
   *
   * @var array
   */
  protected $_config;


    /**
     * Display a listing of Group.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();

        return view('agenda::agenda.admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating new Group.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('agenda::agenda.admin.groups.create');
    }

    /**
     * Store a newly created Group in storage.
     *
     * @param  \Flawless\Agenda\Http\Requests\Admin\StoreGroupsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupsRequest $request)
    {

        $group = Group::create($request->all());


        session()->flash('success', 'Nuevo grupo creado');
        return redirect()->route('agenda.groups.index');
        return redirect()->route($this->_config['redirect']);
    }


    /**
     * Show the form for editing Group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $group = Group::findOrFail($id);

        return view('agenda::agenda.admin.groups.edit', compact('group'));
    }

    /**
     * Update Group in storage.
     *
     * @param  \Flawless\Agenda\Http\Requests\Admin\UpdateGroupsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupsRequest $request, $id)
    {

        $group = Group::findOrFail($id);
        $group->update($request->all());

        session()->flash('success', 'Grupo Actualizado');
        return redirect()->route('agenda.groups.index');
        return redirect()->route($this->_config['redirect']);
    }


    /**
     * Display Group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //
    //     $relations = [
    //         'services' => Flawless\Agenda\Models\Service::where('group_id', $id)->get(),
    //     ];
    //
    //     $group = Group::findOrFail($id);
    //
    //     return view('agenda::agenda.admin.groups.show', compact('group') + $relations);
    // }


    /**
     * Remove Group from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $group = Group::findOrFail($id);
        $group->delete();

        session()->flash('success', 'Grupo Eliminado');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Delete all selected Group at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Group::whereIn('id', $request->input('ids'))->get();

            //request()->input('indexes')

            foreach ($entries as $entry) {
                $entry->delete();
            }


            session()->flash('success', 'Grupo Eliminado');
            return redirect()->route($this->_config['redirect']);
        }
    }

}
