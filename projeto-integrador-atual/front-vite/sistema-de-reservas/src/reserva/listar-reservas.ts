// Interface de Reserva para listar
export interface ReservaListar {
  id: number;
  nomeCliente: string;
  mesa: number; // A mesa é um número agora
  data: string;
  horarioInicial: string;
  horarioTermino: string;
  nomeFuncionario: string;
  status: string;
}
