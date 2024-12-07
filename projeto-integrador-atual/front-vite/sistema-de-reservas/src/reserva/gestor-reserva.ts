import { Reserva } from "./criar-reserva";

export class GestorReservas {
  async listarReservas() {
    try {
      const response = await fetch("http://localhost:8000/reservas", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      });

      if (!response.ok) {
        throw new Error("Erro ao criar a reserva");
      }

      const reservas: Reserva = await response.json();
      return reservas;
    } catch (error) {
      console.error("Erro ao criar reserva:", error);
      throw error;
    }
  }

  async criarReserva(reserva: Reserva): Promise<Reserva> {
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
    } catch (error) {
      console.error("Erro ao criar reserva:", error);
      throw error;
    }
  }
}
