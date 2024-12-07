import { VisaoCriarReservas } from "./visao-criar-reserva";
// // Adding event listeners to the input elements for changes
// document
//   .getElementById("data")
//   ?.addEventListener("change", fetchMesasDisponiveis);

// document
//   .getElementById("horarioInicial")
//   ?.addEventListener("change", fetchMesasDisponiveis);
// async function fetchMesasDisponiveis() {
//   const data = (document.getElementById("data") as HTMLInputElement).value;
//   const horarioInicial = (
//     document.getElementById("horarioInicial") as HTMLSelectElement
//   ).value;

//   if (!data || !horarioInicial) {
//     console.log("Por favor, preencha a data e o horário.");
//     return;
//   }

//   try {
//     const response = await fetch(
//       `http://localhost:8000/mesas-disponiveis?data=${data}&horarioInicial=${horarioInicial}`
//     );

//     // Log the raw response text to see what's returned
//     const rawResponse = await response.text();
//     console.log("Raw Response:", rawResponse);

//     // Check if the response is OK
//     if (!response.ok) {
//       throw new Error("Falha na requisição ao servidor.");
//     }

//     // Try parsing the response as JSON
//     const mesasDisponiveis = JSON.parse(rawResponse);

//     const mesaSelect = document.getElementById("mesa") as HTMLSelectElement;
//     mesaSelect.innerHTML = '<option value="">Selecione a mesa</option>';

//     if (mesasDisponiveis && mesasDisponiveis.length > 0) {
//       mesasDisponiveis.forEach((mesa: any) => {
//         const option = document.createElement("option");
//         option.value = mesa.id;
//         option.textContent = `Mesa ${mesa.id}`;
//         mesaSelect.appendChild(option);
//       });
//     } else {
//       const option = document.createElement("option");
//       option.value = "";
//       option.textContent = "Nenhuma mesa disponível";
//       mesaSelect.appendChild(option);
//     }
//   } catch (error) {
//     console.error("Erro ao carregar mesas disponíveis:", error);
//   }
// }

// // Defina a interface para os funcionários, caso o formato do retorno da API seja conhecido.
// interface Funcionario {
//   id: number;
//   nome: string;
// }

// // Função para buscar os funcionários na API e popular o select
// async function listarFuncionarios() {
//   try {
//     // Altere para o URL correto da sua API
//     const response = await fetch("http://localhost:8000/funcionarios");

//     // Verifique se a resposta foi bem-sucedida
//     if (!response.ok) {
//       throw new Error("Erro ao buscar os funcionários");
//     }

//     // Converta a resposta para JSON
//     const funcionarios: Funcionario[] = await response.json();

//     // Obtenha o elemento <select>
//     const selectFuncionario = document.getElementById(
//       "funcionario"
//     ) as HTMLSelectElement;

//     // Limpe as opções atuais do select
//     selectFuncionario.innerHTML =
//       '<option value="">Selecione o Funcionario</option>';

//     // Preencha o select com os funcionários
//     funcionarios.forEach((funcionario) => {
//       const option = document.createElement("option");
//       option.value = String(funcionario.id); // Use o id do funcionário como valor
//       option.textContent = funcionario.nome; // Use o nome do funcionário como texto
//       selectFuncionario.appendChild(option);
//     });
//   } catch (error) {
//     console.error("Erro ao listar os funcionários:", error);
//   }
// }

// // Chame a função para listar os funcionários quando a página for carregada
// window.onload = listarFuncionarios;

// document
//   .getElementById("formReserva")
//   ?.addEventListener("submit", async function (event) {
//     event.preventDefault(); // Evita o comportamento padrão de envio do formulário

//     const data = (document.getElementById("data") as HTMLInputElement).value;
//     const horarioInicial = (
//       document.getElementById("horarioInicial") as HTMLSelectElement
//     ).value;
//     const funcionarioId = (
//       document.getElementById("funcionario") as HTMLSelectElement
//     ).value;
//     const mesaId = (document.getElementById("mesa") as HTMLSelectElement).value;
//     const nomeCliente = (document.getElementById("nome") as HTMLInputElement)
//       .value;

//     // Verifica se os campos necessários estão preenchidos
//     if (!data || !horarioInicial || !funcionarioId || !mesaId || !nomeCliente) {
//       console.log("Por favor, preencha todos os campos.");
//       return;
//     }

//     // Verifica os dados antes de enviar
//     console.log("Enviando dados:", {
//       nomeCliente,
//       mesa: mesaId,
//       data,
//       horarioInicial,
//       funcionario: funcionarioId,
//     });

//     try {
//       const response = await fetch("http://localhost:8000/reservas", {
//         method: "POST",
//         headers: {
//           "Content-Type": "application/json",
//         },
//         body: JSON.stringify({
//           nomeCliente: nomeCliente, // Correspondente ao campo no backend
//           mesa: mesaId, // Correspondente ao campo no backend
//           data: data, // Correspondente ao campo no backend
//           horarioInicial: horarioInicial, // Correspondente ao campo no backend
//           funcionario: funcionarioId, // Correspondente ao campo no backend
//         }),
//       });

//       if (!response.ok) {
//         throw new Error("Erro ao criar a reserva.");
//       }

//       const reserva = await response.json();

//       // Exibe a reserva feita com sucesso na tela
//       // displayReserva(reserva);
//     } catch (error) {
//       console.error("Erro ao fazer reserva:", error);
//     }
//   });

import { ControladoraFuncionarios } from "../funcionario/funcionario-controller";
import { VisaoFuncionarios } from "../funcionario/visao-funcionario";
import { ControladoraMesas } from "../mesa/mesa-controller";
import { VisaoMesas } from "../mesa/visao-mesa";

// Instancia as visões
const visaoMesas = new VisaoMesas();
const visaoFuncionarios = new VisaoFuncionarios();

const controladoraMesas = new ControladoraMesas(visaoMesas);
const controladoraFuncionarios = new ControladoraFuncionarios(
  visaoFuncionarios
);

const visaoCriarReservas = new VisaoCriarReservas(
  controladoraMesas,
  controladoraFuncionarios
);

// Inicializa a visão de reservas
visaoCriarReservas.iniciar();
