import { Reserva } from "./criar-reserva";
import { GestorReservas } from "./gestor-reserva";
import { VisaoCriarReservas } from "./visao-criar-reserva";

export class ControladoraReservas {
  private gestor: GestorReservas;
  private visao: VisaoCriarReservas;

  constructor(visao: VisaoCriarReservas) {
    this.gestor = new GestorReservas();
    this.visao = visao;
  }

  async criarReserva() {
    const { nomeCliente, mesaId, data, horarioInicial, funcionarioId } =
      this.visao.capturarDadosFormulario();
    try {
      // Cria o objeto de reserva
      const reserva: Reserva = {
        nomeCliente,
        mesaId,
        data,
        horarioInicial,
        funcionarioId, // Corrected to match the destructured variable
      };

      // Envia o objeto para o gestor para criar a reserva
      const reservaCriada = await this.gestor.criarReserva(reserva);
      console.log("Reserva criada com sucesso: ", reservaCriada);
      this.visao.exibirReservaCriada(reserva);
    } catch (error) {
      console.error("Erro ao criar reserva:", error);
      this.visao.exibirErro(error);
    }
  }
}
