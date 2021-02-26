<?php

namespace App\Http\Livewire\System\Jobs;

use App\Models\FailedJob;
use App\Models\Job;
use App\Models\User;
use App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Tables extends Component
{
    use AuthorizesRoleOrPermission;
    public User $user;
    public $paginate_jobs = 5, $paginate_failed = 5;
    private $jobs, $failed_jobs;

    public function mount(User $user)
    {
        $this->authorizeRoleOrPermission('jobs control');
        $this->user = $user;
        $this->workRetryDone();
        $this->workedDone();
    }

    public function hydrate()
    {
        $this->jobs = Job::paginate($this->paginate_jobs);
        $this->failed_jobs = FailedJob::paginate($this->paginate_failed);
    }

    public function workRetryDone()
    {
        $this->jobs = Job::paginate($this->paginate_jobs);
    }

    public function workedDone()
    {
        $this->failed_jobs = FailedJob::paginate($this->paginate_failed);
    }

    public function render()
    {
        return view('livewire.system.jobs.tables', [
            'jobs' => $this->jobs,
            'failed_jobs' => $this->failed_jobs,
        ]);
    }

    public function start_work()
    {
        $message = "No hay trabajos que ejecutar";
        if ( $contador =  $this->jobs->count() ) {
            $message = "Se ejecutaron {$contador} trabajos";
            $this->doit('queue:work', 'workRetryDone');
        }
        // $this->dispatchBrowserEvent('alert', 
        //     ['type' => 'message', 'message' => $message, 'title' => 'Trabajos ejecutados']
        // );
        request()->session()->flash(
            'message',
            $message
        );
        return redirect()->route('dashboard');
    }

    public function work_and_stop()
    {
        $message = "No hay trabajos que ejecutar";
        if ( $contador =  $this->jobs->count() ) {
            $message = "Se ejecutaron {$contador} trabajos, el worker se detuvo al finalizar";
            $this->doit('queue:work --stop-when-empty', 'workRetryDone');
        }
        // $this->dispatchBrowserEvent('alert', 
        //     ['type' => 'message', 'message' => $message, 'title' => 'Trabajos ejecutados']
        // );
        request()->session()->flash(
            'message',
            $message
        );
        return redirect()->route('dashboard');
    }

    public function retry(FailedJob $failed_jobs)
    {
        $message = "No hay trabajos fallidos que ejecutar";
        if ( $this->failed_jobs->count() ) {
            $artisan = "queue:retry {$failed_jobs->uuid}";
            $message = "Se ejecuto el trabajo {$failed_jobs->uuid}";
            $this->doit($artisan, 'workRetryDone');
        }
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'message', 'message' => $message, 'title' => 'Trabajos ejecutados']
        );
    }

    public function cancel(FailedJob $failed_jobs)
    {
        $message = "No hay trabajos fallidos que ejecutar";
        if ( $this->failed_jobs->count() ) {
            $artisan = "queue:forget {$failed_jobs->uuid}";
            $message = "Se cancelo el trabajo {$failed_jobs->uuid}";
            $this->doit($artisan, 'workRetryDone');
        }
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'warning', 'message' => $message, 'title' => 'Trabajos cancelados']
        );
        // request()->session()->flash(
        //     'warning',
        //     $message
        // );
        // return redirect()->route('jobs');
    }

    private function doit(string $artisan, string $event)
    {
        Artisan::call($artisan);
        //$this->workRetryDone();
        $this->emit($event);
    }

    public function delete_job(Job $job)
    {
        $job->delete();
        //$this->workRetryDone();
        $this->emit('workRetryDone');
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'error', 'message' => "Se elimino una tarea. [ID: {$id}]", 'title' => 'Trabajos eliminados']
        );
    }
}
