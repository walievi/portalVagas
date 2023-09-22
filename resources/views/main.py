import asyncio
import socket
import dns.message
from kademlia.network import Server

async def fetch_dns_from_kademlia(domain):
    # Para simplificar, vamos assumir que o servidor Kademlia já contém o registro DNS
    return await kademlia_server.get(domain)

def dns_server():
    sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    sock.bind(('0.0.0.0', 53))  # DNS normalmente usa a porta 53

    while True:
        data, addr = sock.recvfrom(512)
        msg = dns.message.from_wire(data)

        for question in msg.question:
            domain = str(question.name)
            loop = asyncio.get_event_loop()
            response_data = loop.run_until_complete(fetch_dns_from_kademlia(domain))

            if response_data:
                # Construa sua resposta DNS aqui e adicione ao `msg.answer`
                # Este é um exemplo genérico e pode não funcionar para todos os tipos de registros DNS.
                msg.answer.append(response_data)

        sock.sendto(msg.to_wire(), addr)

if __name__ == "__main__":
    # Inicialização do servidor Kademlia
    loop = asyncio.get_event_loop()
    kademlia_server = Server()
    loop.run_until_complete(kademlia_server.listen(5678))

    # Inicialização do servidor DNS
    dns_server()
