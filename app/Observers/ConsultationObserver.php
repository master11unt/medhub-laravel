<?php

namespace App\Observers;

use App\Models\Consultation;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Support\Facades\Log;

class ConsultationObserver
{
    /**
     * Handle the Consultation "created" event.
     */
    public function created(Consultation $consultation): void
    {
        // Update schedule status ketika consultation dibuat
        if ($consultation->schedule_id) {
            $this->updateScheduleStatus($consultation->schedule_id, 'booked');
        }
    }

    /**
     * Handle the Consultation "updated" event.
     */
    public function updated(Consultation $consultation): void
    {
        // Jika status consultation berubah
        if ($consultation->isDirty('status')) {
            $this->handleStatusChange($consultation);
        }
    }

    /**
     * Handle the Consultation "deleted" event.
     */
    public function deleted(Consultation $consultation): void
    {
        // Update schedule status ketika consultation dihapus
        if ($consultation->schedule_id) {
            $this->updateScheduleStatus($consultation->schedule_id, 'available');
        }
    }

    /**
     * Handle the Consultation "restored" event.
     */
    public function restored(Consultation $consultation): void
    {
        // Update schedule status ketika consultation di-restore
        if ($consultation->schedule_id) {
            $this->updateScheduleStatus($consultation->schedule_id, 'booked');
        }
    }

    /**
     * Handle the Consultation "force deleted" event.
     */
    public function forceDeleted(Consultation $consultation): void
    {
        // Update schedule status ketika consultation dihapus permanen
        if ($consultation->schedule_id) {
            $this->updateScheduleStatus($consultation->schedule_id, 'available');
        }
    }

    /**
     * Handle status change logic
     */
    private function handleStatusChange(Consultation $consultation): void
    {
        switch ($consultation->status) {
            case 'in_progress':
                // Update schedule status jadi 'ongoing'
                if ($consultation->schedule_id) {
                    $this->updateScheduleStatus($consultation->schedule_id, 'ongoing');
                }
                break;

            case 'completed':
                // Update schedule status jadi 'completed'
                if ($consultation->schedule_id) {
                    $this->updateScheduleStatus($consultation->schedule_id, 'completed');
                }
                
                // Update appointment status jika terkait
                $this->updateRelatedAppointment($consultation);
                break;

            case 'cancelled':
                // Update schedule status jadi 'available' lagi
                if ($consultation->schedule_id) {
                    $this->updateScheduleStatus($consultation->schedule_id, 'available');
                }
                break;

            case 'pending':
                // Update schedule status jadi 'booked'
                if ($consultation->schedule_id) {
                    $this->updateScheduleStatus($consultation->schedule_id, 'booked');
                }
                break;
        }
    }

    /**
     * Update schedule status
     */
    private function updateScheduleStatus(int $scheduleId, string $status): void
    {
        $schedule = Schedule::find($scheduleId);
        if ($schedule && $schedule->status !== $status) {
            $schedule->status = $status;
            $schedule->save();
            
            // Log untuk debugging
            Log::info("Schedule #{$scheduleId} status updated to: {$status}");
        }
    }

    /**
     * Update related appointment status
     */
    private function updateRelatedAppointment(Consultation $consultation): void
    {
        if (!$consultation->schedule_id) {
            return;
        }

        // Cari appointment berdasarkan schedule_id yang sama
        $appointment = Appointment::where('schedule_id', $consultation->schedule_id)
                                 ->where('status', 'pending')
                                 ->first();

        if ($appointment) {
            $appointment->status = 'completed';
            $appointment->save();
            
            // Log untuk debugging
            Log::info("Appointment #{$appointment->id} status updated to completed");
        }
    }
}
