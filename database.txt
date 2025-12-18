--
-- Database: `milanocortina`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `addetti_sicurezza`
--

CREATE TABLE `addetti_sicurezza` (
  `ID_Security` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Qualifica` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `ID_Utente` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

CREATE TABLE `eventi` (
  `ID_Evento` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `ID_Fanzone` int(11) DEFAULT NULL,
  `ID_Location` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `fanzone`
--

CREATE TABLE `fanzone` (
  `ID_Fanzone` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE `iscrizioni` (
  `ID_Iscrizione` int(11) NOT NULL,
  `ID_Utente` int(11) DEFAULT NULL,
  `ID_Evento` int(11) DEFAULT NULL,
  `Data_Iscrizione` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `location`
--

CREATE TABLE `location` (
  `ID_Location` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Indirizzo` varchar(255) DEFAULT NULL,
  `Citta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ospiti`
--

CREATE TABLE `ospiti` (
  `ID_Ospiti` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ospiti_eventi`
--

CREATE TABLE `ospiti_eventi` (
  `ID_Evento` int(11) NOT NULL,
  `ID_Ospiti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `servizi`
--

CREATE TABLE `servizi` (
  `Tipo_Servizio` varchar(50) NOT NULL,
  `Descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `servizi_eventi`
--

CREATE TABLE `servizi_eventi` (
  `ID_Evento` int(11) NOT NULL,
  `Tipo_Servizio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `vip`
--

CREATE TABLE `vip` (
  `Nome` varchar(100) NOT NULL,
  `Categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `vip_eventi`
--

CREATE TABLE `vip_eventi` (
  `ID_Evento` int(11) NOT NULL,
  `Nome_VIP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `addetti_sicurezza`
--
ALTER TABLE `addetti_sicurezza`
  ADD PRIMARY KEY (`ID_Security`);

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`ID_Utente`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `eventi`
--
ALTER TABLE `eventi`
  ADD PRIMARY KEY (`ID_Evento`),
  ADD KEY `ID_Fanzone` (`ID_Fanzone`),
  ADD KEY `ID_Location` (`ID_Location`);

--
-- Indici per le tabelle `fanzone`
--
ALTER TABLE `fanzone`
  ADD PRIMARY KEY (`ID_Fanzone`);

--
-- Indici per le tabelle `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD PRIMARY KEY (`ID_Iscrizione`),
  ADD KEY `ID_Utente` (`ID_Utente`),
  ADD KEY `ID_Evento` (`ID_Evento`);

--
-- Indici per le tabelle `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`ID_Location`);

--
-- Indici per le tabelle `ospiti`
--
ALTER TABLE `ospiti`
  ADD PRIMARY KEY (`ID_Ospiti`);

--
-- Indici per le tabelle `ospiti_eventi`
--
ALTER TABLE `ospiti_eventi`
  ADD PRIMARY KEY (`ID_Evento`,`ID_Ospiti`),
  ADD KEY `ID_Ospiti` (`ID_Ospiti`);

--
-- Indici per le tabelle `servizi`
--
ALTER TABLE `servizi`
  ADD PRIMARY KEY (`Tipo_Servizio`);

--
-- Indici per le tabelle `servizi_eventi`
--
ALTER TABLE `servizi_eventi`
  ADD PRIMARY KEY (`ID_Evento`,`Tipo_Servizio`),
  ADD KEY `Tipo_Servizio` (`Tipo_Servizio`);

--
-- Indici per le tabelle `vip`
--
ALTER TABLE `vip`
  ADD PRIMARY KEY (`Nome`);

--
-- Indici per le tabelle `vip_eventi`
--
ALTER TABLE `vip_eventi`
  ADD PRIMARY KEY (`ID_Evento`,`Nome_VIP`),
  ADD KEY `Nome_VIP` (`Nome_VIP`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `eventi`
--
ALTER TABLE `eventi`
  ADD CONSTRAINT `eventi_ibfk_1` FOREIGN KEY (`ID_Fanzone`) REFERENCES `fanzone` (`ID_Fanzone`),
  ADD CONSTRAINT `eventi_ibfk_2` FOREIGN KEY (`ID_Location`) REFERENCES `location` (`ID_Location`);

--
-- Limiti per la tabella `iscrizioni`
--
ALTER TABLE `iscrizioni`
  ADD CONSTRAINT `iscrizioni_ibfk_1` FOREIGN KEY (`ID_Utente`) REFERENCES `clienti` (`ID_Utente`),
  ADD CONSTRAINT `iscrizioni_ibfk_2` FOREIGN KEY (`ID_Evento`) REFERENCES `eventi` (`ID_Evento`);

--
-- Limiti per la tabella `ospiti_eventi`
--
ALTER TABLE `ospiti_eventi`
  ADD CONSTRAINT `ospiti_eventi_ibfk_1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventi` (`ID_Evento`),
  ADD CONSTRAINT `ospiti_eventi_ibfk_2` FOREIGN KEY (`ID_Ospiti`) REFERENCES `ospiti` (`ID_Ospiti`);

--
-- Limiti per la tabella `servizi_eventi`
--
ALTER TABLE `servizi_eventi`
  ADD CONSTRAINT `servizi_eventi_ibfk_1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventi` (`ID_Evento`),
  ADD CONSTRAINT `servizi_eventi_ibfk_2` FOREIGN KEY (`Tipo_Servizio`) REFERENCES `servizi` (`Tipo_Servizio`);

--
-- Limiti per la tabella `vip_eventi`
--
ALTER TABLE `vip_eventi`
  ADD CONSTRAINT `vip_eventi_ibfk_1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventi` (`ID_Evento`),
  ADD CONSTRAINT `vip_eventi_ibfk_2` FOREIGN KEY (`Nome_VIP`) REFERENCES `vip` (`Nome`);
COMMIT;








Relazione sul database milanocortina
1. Introduzione

Il database milanocortina, realizzato tramite phpMyAdmin e basato su MariaDB, è progettato per gestire l’organizzazione di eventi. 
La struttura permette di amministrare utenti, eventi, location, fanzone, ospiti, VIP e servizi, mantenendo i dati coerenti e ben collegati tra loro grazie all’uso di chiavi primarie e chiavi esterne.

2. Struttura generale

Il database è composto da diverse tabelle, ognuna con un ruolo specifico. La progettazione segue un modello relazionale ben organizzato, 
che evita ridondanze e consente di gestire facilmente relazioni uno-a-molti e molti-a-molti.

3. Tabelle principali
3.1 Clienti

La tabella clienti contiene le informazioni sugli utenti registrati alla piattaforma. Ogni cliente è identificato da un ID univoco e da un’email, che è impostata come unica per evitare duplicazioni.
Questa tabella è fondamentale perché rappresenta le persone che possono iscriversi agli eventi.

3.2 Eventi

La tabella eventi è il fulcro del database. In essa sono memorizzati il nome e la data di ciascun evento. Ogni evento è collegato:

a una location, che indica il luogo fisico in cui si svolge;

a una fanzone, ovvero un’area dedicata al pubblico e ai tifosi.

Questi collegamenti permettono di contestualizzare ogni evento in modo preciso.

3.3 Location e Fanzone

La tabella location raccoglie i dati relativi ai luoghi degli eventi, come nome, indirizzo e città.
La tabella fanzone, invece, descrive le aree dedicate ai fan, fornendo una descrizione utile a distinguerle tra loro.
Entrambe sono collegate alla tabella eventi tramite chiavi esterne.

4. Gestione delle iscrizioni

La partecipazione degli utenti agli eventi è gestita dalla tabella iscrizioni.
Questa tabella mette in relazione i clienti con gli eventi e registra anche la data di iscrizione. In questo modo:

un cliente può iscriversi a più eventi;

un evento può avere più partecipanti.

Si tratta quindi di una relazione molti-a-molti gestita in modo corretto.

5. Ospiti e VIP

Il database prevede la presenza di ospiti speciali e VIP.

La tabella ospiti contiene i dati degli ospiti.

La tabella vip è dedicata ai VIP, distinguendoli per categoria.

Per entrambe le entità esistono tabelle di collegamento (ospiti_eventi e vip_eventi) che permettono di associare più ospiti o VIP a uno stesso evento, 
rendendo il sistema flessibile e adatto a eventi di grande importanza.

6. Servizi

I servizi disponibili durante gli eventi sono memorizzati nella tabella servizi, che ne descrive il tipo e le caratteristiche.
La tabella servizi_eventi consente di associare uno o più servizi a ciascun evento, permettendo una gestione dettagliata dell’organizzazione.

7. Addetti alla sicurezza

La tabella addetti_sicurezza contiene le informazioni sul personale addetto alla sicurezza, come nome e qualifica.
Attualmente non è collegata alle altre tabelle, ma può essere facilmente integrata in futuro per associare gli addetti agli eventi o alle location.

8. Conclusione

Il database milanocortina risulta ben strutturato, coerente e facilmente espandibile. L’uso corretto delle chiavi primarie e delle chiavi esterne garantisce l’integrità dei dati, 
mentre la suddivisione in tabelle collegate rende il sistema chiaro ed efficiente. Nel complesso, rappresenta un buon esempio di database relazionale per la gestione completa di eventi complessi.
