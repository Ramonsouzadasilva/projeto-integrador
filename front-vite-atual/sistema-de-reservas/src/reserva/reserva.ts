// /src/ts/model/Reserva.ts
export class Reserva {
  nomeCliente: string;
  mesa: number;
  data: string;
  horarioInicial: string;
  funcionario: string;

  constructor(
    nomeCliente: string,
    mesa: number,
    data: string,
    horarioInicial: string,
    funcionario: string
  ) {
    this.nomeCliente = nomeCliente;
    this.mesa = mesa;
    this.data = data;
    this.horarioInicial = horarioInicial;
    this.funcionario = funcionario;
  }

  // Método para validar os dados da reserva
  validar(): string[] {
    const erros: string[] = [];
    if (!this.nomeCliente) erros.push("Nome do cliente é obrigatório");
    if (!this.data) erros.push("Data é obrigatória");
    if (!this.horarioInicial) erros.push("Horário inicial é obrigatório");
    if (!this.mesa) erros.push("Mesa é obrigatória");
    if (!this.funcionario) erros.push("Funcionário é obrigatório");
    return erros;
  }
}
