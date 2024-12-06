// /src/ts/view/CadastroView.ts
export class CadastroView {
  formElement: HTMLFormElement;
  nomeInput: HTMLInputElement;
  mesaInput: HTMLInputElement;
  dataInput: HTMLInputElement;
  horarioInput: HTMLInputElement;
  funcionarioInput: HTMLInputElement;
  submitButton: HTMLButtonElement;

  constructor() {
    this.formElement = document.querySelector(
      "#formReserva"
    ) as HTMLFormElement;
    this.nomeInput = document.querySelector("#nomeCliente") as HTMLInputElement;
    this.mesaInput = document.querySelector("#mesa") as HTMLInputElement;
    this.dataInput = document.querySelector("#data") as HTMLInputElement;
    this.horarioInput = document.querySelector(
      "#horarioInicial"
    ) as HTMLInputElement;
    this.funcionarioInput = document.querySelector(
      "#funcionario"
    ) as HTMLInputElement;
    this.submitButton = document.querySelector("#submit") as HTMLButtonElement;
  }

  // Exibe uma mensagem para o usuário
  mostrarMensagem(mensagem: string) {
    alert(mensagem);
  }

  // Obtém os dados do formulário
  obterDadosFormulario(): any {
    return {
      nomeCliente: this.nomeInput.value,
      mesa: parseInt(this.mesaInput.value),
      data: this.dataInput.value,
      horarioInicial: this.horarioInput.value,
      funcionario: this.funcionarioInput.value,
    };
  }

  // Adiciona o listener de envio do formulário
  adicionarListenerEnvio(callback: (dados: any) => void) {
    this.formElement.addEventListener("submit", (event) => {
      event.preventDefault();
      const dados = this.obterDadosFormulario();
      callback(dados);
    });
  }
}
