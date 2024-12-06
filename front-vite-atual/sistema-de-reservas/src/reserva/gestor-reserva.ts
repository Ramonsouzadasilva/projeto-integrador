// /src/ts/presenter/CadastroPresenter.ts

import { Reserva } from "./reserva";
import { CadastroView } from "./visao-reserva";

export class CadastroPresenter {
  private view: CadastroView;

  constructor(view: CadastroView) {
    this.view = view;

    // Define o que ocorre quando o formulário é enviado
    this.view.adicionarListenerEnvio(this.handleSubmit.bind(this));
  }

  // Manipulador do envio do formulário
  private async handleSubmit(dados: any) {
    // Criar uma nova instância do modelo Reserva
    const reserva = new Reserva(
      dados.nomeCliente,
      dados.mesa,
      dados.data,
      dados.horarioInicial,
      dados.funcionario
    );

    // Validar os dados da reserva
    const erros = reserva.validar();
    if (erros.length > 0) {
      this.view.mostrarMensagem("Erro de validação: " + erros.join(", "));
      return;
    }

    // Fazer a requisição POST para o backend
    try {
      const resposta = await this.criarReservaBackend(reserva);
      if (resposta.status === "success") {
        this.view.mostrarMensagem("Reserva realizada com sucesso!");
      } else {
        this.view.mostrarMensagem("Erro: " + resposta.message);
      }
    } catch (erro: unknown) {
      const e = erro as Error; // Assumindo que erro é um Error
      this.view.mostrarMensagem(
        "Erro de comunicação com o servidor: " + e.message
      );
    }
  }

  // Função que faz o POST para o backend
  private async criarReservaBackend(reserva: Reserva): Promise<any> {
    const response = await fetch("/api/reservas", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        nomeCliente: reserva.nomeCliente,
        mesa: reserva.mesa,
        data: reserva.data,
        horarioInicial: reserva.horarioInicial,
        funcionario: reserva.funcionario,
      }),
    });

    return response.json();
  }
}
