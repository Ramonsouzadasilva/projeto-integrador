import { ReservaListar } from "./listar-reservas";
import { ControladoraListarReservas } from "./reserva-controller-listar";

export class VisaoListarReservas {
  controladoraReserva: ControladoraListarReservas;

  constructor() {
    this.controladoraReserva = new ControladoraListarReservas(this);
  }

  iniciar() {
    this.controladoraReserva.ListarReservas();
  }

  /**
   * Desenha as reservas na tabela.
   * @param {Reserva[]} reservas
   */
  desenharReservas(reservas: ReservaListar[]): void {
    const tbody = document.querySelector("tbody") as HTMLElement;
    tbody.innerText = "";
    const fragmento = document.createDocumentFragment();

    reservas.forEach((reserva) => {
      const linha = this.criarLinha(reserva);
      fragmento.append(linha);
    });

    tbody.appendChild(fragmento);
  }

  /**
   * Cria uma linha de tabela a partir de uma reserva.
   * @param {Reserva} reserva
   * @returns {HTMLTableRowElement}
   */
  criarLinha(reserva: ReservaListar): HTMLTableRowElement {
    const tr = document.createElement("tr");

    tr.append(
      this.criarCelula(reserva.id),
      this.criarCelula(reserva.nomeCliente),
      this.criarCelula(reserva.mesa),
      this.criarCelula(reserva.data),
      this.criarCelula(reserva.horarioInicial),
      this.criarCelula(reserva.horarioTermino),
      this.criarCelula(reserva.nomeFuncionario),
      this.criarCelula(reserva.status)
    );
    return tr;
  }

  /**
   * Cria uma célula de tabela.
   * @param {string} texto
   * @returns {HTMLTableCellElement}
   */
  criarCelula(texto: string): HTMLTableCellElement {
    const td = document.createElement("td");
    td.innerText = texto;
    return td;
  }
}
