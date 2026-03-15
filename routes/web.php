<?php

use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\ClientServiceController as AdminClientServiceController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\Admin\OpportunityController as AdminOpportunityController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProposalController as AdminProposalController;
use App\Http\Controllers\Admin\RenewalController as AdminRenewalController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PartnerController;
use App\Http\Controllers\Site\PrivacyPolicyController;
use App\Http\Controllers\Site\ProposalRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('site.home');
Route::get('/parceiros', [PartnerController::class, 'index'])->name('site.partners');
Route::get('/contato', [ContactController::class, 'index'])->name('site.contact');
Route::get('/politica-de-privacidade', PrivacyPolicyController::class)->name('site.privacy');
Route::post('/solicitar-proposta', [ProposalRequestController::class, 'store'])
    ->middleware('throttle:public-lead-form')
    ->name('site.proposals.store');

Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');

    Route::get('/leads', [AdminLeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/criar', [AdminLeadController::class, 'create'])->name('leads.create');
    Route::post('/leads', [AdminLeadController::class, 'store'])->name('leads.store');
    Route::get('/leads/{lead}', [AdminLeadController::class, 'show'])->name('leads.show');
    Route::get('/leads/{lead}/editar', [AdminLeadController::class, 'edit'])->name('leads.edit');
    Route::put('/leads/{lead}', [AdminLeadController::class, 'update'])->name('leads.update');
    Route::post('/leads/{lead}/converter', [AdminLeadController::class, 'convert'])->name('leads.convert');

    Route::get('/clientes', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/clientes/criar', [AdminClientController::class, 'create'])->name('clients.create');
    Route::post('/clientes', [AdminClientController::class, 'store'])->name('clients.store');
    Route::get('/clientes/{client}', [AdminClientController::class, 'show'])->name('clients.show');
    Route::get('/clientes/{client}/editar', [AdminClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clientes/{client}', [AdminClientController::class, 'update'])->name('clients.update');
    Route::post('/clientes/{client}/servicos', [AdminClientServiceController::class, 'store'])->name('clients.services.store');
    Route::put('/clientes/{client}/servicos/{clientService}', [AdminClientServiceController::class, 'update'])->name('clients.services.update');

    Route::get('/oportunidades', [AdminOpportunityController::class, 'index'])->name('opportunities.index');
    Route::get('/oportunidades/criar', [AdminOpportunityController::class, 'create'])->name('opportunities.create');
    Route::post('/oportunidades', [AdminOpportunityController::class, 'store'])->name('opportunities.store');
    Route::get('/oportunidades/{opportunity}', [AdminOpportunityController::class, 'show'])->name('opportunities.show');
    Route::get('/oportunidades/{opportunity}/editar', [AdminOpportunityController::class, 'edit'])->name('opportunities.edit');
    Route::put('/oportunidades/{opportunity}', [AdminOpportunityController::class, 'update'])->name('opportunities.update');

    Route::get('/propostas', [AdminProposalController::class, 'index'])->name('proposals.index');
    Route::get('/propostas/criar', [AdminProposalController::class, 'create'])->name('proposals.create');
    Route::post('/propostas', [AdminProposalController::class, 'store'])->name('proposals.store');
    Route::get('/propostas/{proposal}', [AdminProposalController::class, 'show'])->name('proposals.show');
    Route::get('/propostas/{proposal}/editar', [AdminProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('/propostas/{proposal}', [AdminProposalController::class, 'update'])->name('proposals.update');
    Route::post('/propostas/{proposal}/aceitar', [AdminProposalController::class, 'accept'])->name('proposals.accept');

    Route::get('/renovacoes', [AdminRenewalController::class, 'index'])->name('renewals.index');
    Route::get('/renovacoes/criar', [AdminRenewalController::class, 'create'])->name('renewals.create');
    Route::post('/renovacoes', [AdminRenewalController::class, 'store'])->name('renewals.store');
    Route::get('/renovacoes/{renewal}', [AdminRenewalController::class, 'show'])->name('renewals.show');
    Route::get('/renovacoes/{renewal}/editar', [AdminRenewalController::class, 'edit'])->name('renewals.edit');
    Route::put('/renovacoes/{renewal}', [AdminRenewalController::class, 'update'])->name('renewals.update');

    Route::get('/produtos', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/produtos/criar', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/produtos', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/produtos/{product}/editar', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/produtos/{product}', [AdminProductController::class, 'update'])->name('products.update');

    Route::get('/parceiros', [AdminPartnerController::class, 'index'])->name('partners.index');
    Route::get('/parceiros/criar', [AdminPartnerController::class, 'create'])->name('partners.create');
    Route::post('/parceiros', [AdminPartnerController::class, 'store'])->name('partners.store');
    Route::get('/parceiros/{partner}/editar', [AdminPartnerController::class, 'edit'])->name('partners.edit');
    Route::put('/parceiros/{partner}', [AdminPartnerController::class, 'update'])->name('partners.update');

    Route::get('/configuracoes', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/configuracoes', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/notas', [AdminNoteController::class, 'store'])->name('notes.store');
});

require __DIR__.'/auth.php';
