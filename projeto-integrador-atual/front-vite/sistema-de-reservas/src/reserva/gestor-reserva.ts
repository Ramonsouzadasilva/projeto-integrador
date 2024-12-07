import { Reserva } from "./criar-reserva";
import { ReservaListar } from "./listar-reservas";

export class GestorReservas {
  async criarReserva(reserva: Reserva): Promise<Reserva> {
    console.log(reserva);

    try {
      const response = await fetch("http://localhost:8000/reservas", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(reserva),
      });

      if (!response.ok) {
        throw new Error("Erro ao criar a reserva");
      }

      const reservaCriada: Reserva = await response.json();
      return reservaCriada;
      console.log(reservaCriada);
    } catch (error) {
      console.error("Erro ao criar reserva:", error);
      throw error;
    }
  }

  async listarReservas(): Promise<ReservaListar[]> {
    try {
      const response = await fetch("http://localhost:8000/reservas", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      });

      if (!response.ok) {
        throw new Error("Erro ao listar as reservas");
      }

      const reservas: ReservaListar[] = await response.json();
      return reservas;
      console.log(reservas);
    } catch (error) {
      console.error("Erro ao listar reservas:", error);
      throw error;
    }
  }
}
