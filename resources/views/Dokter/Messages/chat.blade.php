@extends('layouts.app')

@section('title', 'Chat Konsultasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Chat Konsultasi dengan {{ $consultation->user->name }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('dokter.consultations') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
        <div class="section-body">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Riwayat Chat</h4>
                </div>
                <div class="card-body" style="max-height:400px; overflow-y:auto;">
                    @forelse($messages as $msg)
                        <div class="mb-3">
                            <strong>{{ $msg->sender->name }}:</strong>
                            <span>{{ $msg->message_text }}</span>
                            @if($msg->attachment_path)
                                <br>
                                <a href="{{ asset('storage/'.$msg->attachment_path) }}" target="_blank" class="badge badge-info">Lihat Lampiran</a>
                            @endif
                            <div class="text-muted" style="font-size:12px;">{{ $msg->sent_at }}</div>
                        </div>
                    @empty
                        <div class="text-center text-muted">Belum ada pesan.</div>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Kirim Pesan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.consultations.chat.send', $consultation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea name="message_text" class="form-control" placeholder="Tulis pesan..." required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="attachment" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection