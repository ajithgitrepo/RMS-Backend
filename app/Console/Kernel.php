<?php
   
namespace App\Console;
    
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
    
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendApprovalCron::class,
        Commands\stock_report::class,
        Commands\weekly_stock::class,
        Commands\monthly_stock::class,
    
    ];
     
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    
        $firstdate = date('d');

    	
        $schedule->command('demo:cron')
                 ->everyMinute();
    
    
        $schedule->command('stock_report:stock_report')
                  ->everyMinute();
    
    
        if($firstdate =="01")
        {
            
            $schedule->command('monthly_stock:monthly_stock')
                ->everyMinute();
        }

        if(Carbon::now()->format('N') == '1')  //check if today is Monday
        {      $schedule->command('weekly_stock:weekly_stock')
                    ->everyMinute();
        }

    }
     
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
     
        require base_path('routes/console.php');
    }
}