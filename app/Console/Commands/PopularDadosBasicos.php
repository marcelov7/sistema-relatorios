<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Local;
use App\Models\Equipamento;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class PopularDadosBasicos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sistema:popular-dados-basicos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popular dados básicos do sistema (usuários, locais, equipamentos)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Populando dados básicos do sistema...');

        // Criar roles
        $this->info('📋 Criando roles...');
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);
        $usuarioRole = Role::firstOrCreate(['name' => 'usuario']);

        // Criar usuários
        $this->info('👥 Criando usuários...');
        
        $admin = User::firstOrCreate(
            ['email' => 'admin@sistema.com'],
            [
                'name' => 'Administrador',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'cargo' => 'Administrador',
                'departamento' => 'TI',
                'ativo' => true,
            ]
        );
        $admin->assignRole('admin');

        $teste = User::firstOrCreate(
            ['email' => 'teste@sistema.com'],
            [
                'name' => 'Usuário Teste',
                'username' => 'teste',
                'password' => Hash::make('teste123'),
                'cargo' => 'Técnico',
                'departamento' => 'Manutenção',
                'ativo' => true,
            ]
        );
        $teste->assignRole('usuario');

        $marcelo = User::firstOrCreate(
            ['email' => 'marcelo@sistema.com'],
            [
                'name' => 'Marcelo',
                'username' => 'marcelo',
                'password' => Hash::make('123456'),
                'cargo' => 'Supervisor',
                'departamento' => 'Operações',
                'ativo' => true,
            ]
        );
        $marcelo->assignRole('supervisor');

        // Criar locais
        $this->info('📍 Criando locais...');
        Local::firstOrCreate(
            ['nome' => 'Prédio Principal'],
            [
                'descricao' => 'Prédio principal da empresa',
                'endereco' => 'Rua Principal, 123',
                'ativo' => true,
            ]
        );

        Local::firstOrCreate(
            ['nome' => 'Galpão A'],
            [
                'descricao' => 'Galpão de produção A',
                'endereco' => 'Setor Industrial',
                'ativo' => true,
            ]
        );

        Local::firstOrCreate(
            ['nome' => 'Área Externa'],
            [
                'descricao' => 'Área externa e pátio',
                'endereco' => 'Área externa',
                'ativo' => true,
            ]
        );

        // Criar equipamentos
        $this->info('⚙️ Criando equipamentos...');
        Equipamento::firstOrCreate(
            ['nome' => 'Gerador Principal'],
            [
                'modelo' => 'GEN-500',
                'fabricante' => 'PowerGen',
                'numero_serie' => 'PG2023001',
                'descricao' => 'Gerador principal de 500kVA',
                'ativo' => true,
            ]
        );

        Equipamento::firstOrCreate(
            ['nome' => 'Motor Elétrico 1'],
            [
                'modelo' => 'ME-100',
                'fabricante' => 'MotorTech',
                'numero_serie' => 'MT2023001',
                'descricao' => 'Motor elétrico 100HP',
                'ativo' => true,
            ]
        );

        Equipamento::firstOrCreate(
            ['nome' => 'Compressor de Ar'],
            [
                'modelo' => 'CA-50',
                'fabricante' => 'CompAir',
                'numero_serie' => 'CA2023001',
                'descricao' => 'Compressor de ar 50HP',
                'ativo' => true,
            ]
        );

        $this->info('✅ Dados básicos populados com sucesso!');
        $this->info('');
        $this->info('👤 Usuários criados:');
        $this->info('   - admin@sistema.com / admin123 (Administrador)');
        $this->info('   - teste@sistema.com / teste123 (Usuário)');
        $this->info('   - marcelo@sistema.com / 123456 (Supervisor)');
        
        return 0;
    }
}
