<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\VoteFormRequest;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{

    public function index()
    {
        return view("votes.index", [
            'votes' => Vote::all()->where('status', '=', "in_progress"),
            'status' => "in_progress",
            ]);
    }

    public function archives()
    {
        return view("votes.index", [
            'votes' => Vote::all()->where('status', '!=', "in_progress"),
            'status' => "not_in_progress",
        ]);
    }

    public function show(Vote $vote)
    {
        return view('votes.show', ['vote' => $vote]);
    }

    public function create()
    {
        return view('votes.create');
    }

    public function store(VoteFormRequest $request)
    {
        $input = $request->safe()->only(['title', 'description', 'final_date']);
        $vote = Auth::user()->votes()->create($input);
        return redirect(route('index') . "#" . $vote->id)/*->with('success', "Le référendum a bien été créé.")*/;
    }

    public function edit(Vote $vote)
    {
        return view('votes.edit', ['vote' => $vote]);
    }

    public function update(VoteFormRequest $request, Vote $vote)
    {
        $input = $request->safe()->only(['title', 'description', 'final_date']);
        $vote->update($input);
        if ($vote->status === 'in_progress'){
            return redirect(route('index') . "#" . $vote->id)/*->with('success', "Le référendum a bien été mis à jour.")*/;
        }
        return redirect(route('votes.archives') . "#" . $vote->id)/*->with('success', "Le référendum a bien été mis à jour.")*/;
    }

    public function destroy(Vote $vote)
    {
        if (Auth::user() == $vote->user || Auth::user()->role == RoleEnum::Admin->value)
        {
            $vote->delete();
            return redirect(route('index'))/*->with('success', 'The client as been successfully deleted')*/;
        }
        return redirect(route('index'))/*->with('error', "You cannot delete this client")*/;
    }

    public function finish(Vote $vote)
    {
        $vote->update(['status' => "done"]);
        return redirect(route('votes.show', $vote))/*->with('success', "Le référendum a bien été clôturé.")*/;
    }

    public function decline(Vote $vote)
    {
        if ($vote->status === "in_progress") {
            return redirect(route('votes.show', $vote))/*->with('error', "Vous ne pouvez pas accepter ou décliner un référendum en cours.")*/;
        }
        $vote->update(['status' => "declined"]);
        return redirect(route('votes.show', $vote))/*->with('success', "Le référendum a bien été décliné.")*/;
    }

    public function accept(Vote $vote)
    {
        if ($vote->status === "in_progress") {
            return redirect(route('votes.show', $vote))/*->with('error', "Vous ne pouvez pas accepter ou décliner un référendum en cours.")*/;
        }
        $vote->update(['status' => "accepted"]);
        return redirect(route('votes.show', $vote))/*->with('success', "Le référendum a bien été accepté.")*/;
    }

    public function voteYes(Vote $vote)
    {
        if ($vote->votings->isEmpty()) {
            $yes = ['yes' => $vote->yes+1];
            $vote->update($yes);
            Auth::user()->votings()->attach($vote);
            return redirect(route('index') . "#" . $vote->id);
        }
        return redirect(route('index') . "#" . $vote->id)/*>with('error', "Vous avez déjà voté.")*/;
    }

    public function voteNo(Vote $vote)
    {
        if ($vote->votings->isEmpty()) {
            $no = ['no' => $vote->no+1];
            $vote->update($no);
            Auth::user()->votings()->attach($vote);
            return redirect(route('index') . "#" . $vote->id);
        }
        return redirect(route('index') . "#" . $vote->id)/*->with('error', "Vous avez déjà voté.")*/;
    }
}
