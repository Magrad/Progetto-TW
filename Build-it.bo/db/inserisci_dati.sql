-- -----------------------------------------------------
-- Insert Admin into `accounts`
-- -----------------------------------------------------
INSERT INTO `accounts` (id, username, fullname, password, email, image, permissions) VALUES (1, "Magrad", "Andrea Micheli", "$2y$10$wYoSR8ZlnXzFHUdUPjSeA.zJ3loG9d0pQaxjEgdI6ZUcEcJVw2Iye", "admin@admin.com", NULL, 1);

-- -----------------------------------------------------
-- Insert Products into `products`
-- -----------------------------------------------------
INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("AMD Ryzen 5 5600G", 10, "Processore AMD, AMD Ryzen 5 5xxx serie G processore Desktop con Radeon Graphics, numero di core: 6, numero di threads: 12, Boost Clock: fino a 4.4GHz, Clock base: 3.9GHz, L2 Cache: 3MB, L3 Cache: 16MB, TDP: 65W, Overclock: si, CPU Socket: AM4", "Radeon Graphics integrata
# CPU Cores: 6
# Threads: 12
Clock Boost massimo: fino a 4.4GHz
Clock base: 3.9GHz
TDP: 65W", 277.91, 0, "AMD-Ryzen-5-5600G.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("AMD Ryzen 7 5700G", 5, "Processore AMD, AMD Ryzen 7 5xxx serie G processore Desktop con Radeon Graphics, numero di core: 8, numero di threads: 16, Boost Clock: fino a 4.6GHz, Clock base: 3.8GHz, L2 Cache: 4MB, L3 Cache: 16MB, TDP: 65W, Overclock: si, CPU Socket: AM4", "Radeon Graphics integrata
# CPU Cores: 8
# Threads: 16
Boost Clock massimo: fino a 4.6GHz
Clock base: 3.8GHz
TDP: 65W", 385.21, 0, "AMD-Ryzen-7-5700G.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("AMD Ryzen 7 5800X", 2, "Processore AMD, AMD Ryzen 5xxx serie processore Desktop, numero di core: 8, numero di threads: 16, Boost Clock: fino a 4.7GHz, Clock base: 3.8GHz, L2 Cache: 4MB, L3 Cache: 32MB, TDP: 105W, Overclock: si, CPU Socket: AM4", "Scheda Grafica non integrata
# CPU Cores: 8
# Threads: 16
Boost Clock massimo: fino a 4.7GHz
Clock base: 3.8GHz
TDP: 105W", 481.79, 0, "AMD-Ryzen-7-5700G.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("NVIDIA GeForce RTX 3070Ti", 1, "Scheda Video NVIDIA, NVIDIA GeForce RTX 3xxx serie, architettura NVIDIA: Ampere, Clock base: 1.58GHz, configurazione memoria: 8GB GDDR6X, ampiezza interfaccia: 256-bit, risoluzione massima: 7680x4320, connettori display: HDMI, 3x DisplayPort", "NVIDIA CUDA Cores: 6144
Boost Clock: 1.77GHz
Dimensioni memoria: 8GB
Tecnologie memoria: GDDR6X", 619, 0, "NVIDIA-GeForce-RTX-3070Ti.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("NVIDIA GeForce RTX 3080Ti", 0, "Scheda Video NVIDIA, NVIDIA GeForce RTX 3xxx serie, architettura NVIDIA: Ampere, Clock base: 1.37GHz, configurazione memoria: 12GB GDDR6X, ampiezza interfaccia: 384-bit, risoluzione massima: 7680x4320, connettori display: HDMI, 3x DisplayPort", "NVIDIA CUDA Cores: 10240
Boost Clock: 1.67GHz
Dimensioni memoria: 12GB
Tecnologie memoria: GDDR6X", 1199, 0, "NVIDIA-GeForce-RTX-3080Ti.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("AMD Radeon RX 6800XT", 2, "Scheda Video AMD, AMD Radeon RX 6xxx serie, unità di computazione: 72, acceleratori Ray-tracing: 72, infinity cache: 128MB, velocità memoria: 16Gbps, interfaccia memoria: 256bit, connettività: DisplayPort, HDMI, USB Type-C, TDP: 300W", "Unità di computazione: 72
Acceleratori Ray-tracing: 72
Clock in gioco: fino a 2015 MHz
Dimensioni memoria: 16 GB
Tecnologie memoria: GDDR6", 696.39, 0, "AMD-Radeon-RX-6800XT.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("AMD Radeon RX 6700XT", 1, "Scheda Video AMD, AMD Radeon RX 6xxx serie, unità di computazione: 40, acceleratori Ray-tracing: 40, interfaccia memoria: 192-bit, connettività: DisplayPort, HDMI, TDP: 230W", "Unità di computazione: 40
Acceleratori Ray-tracing: 40
Clock in gioco: fino a 2433 MHz
Dimensioni memoria: 12 GB
Tecnologie memoria: GDDR6", 513.98, 0, "AMD-Radeon-RX-6700XT.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Intel Core i9-11900K", 6, "Processore Intel, Intel Core i9-11xxx serie, numero core: 8, numero threads: 16, litografia: 14nm, cache: 16MB Intel Smart Cache, socket: FCLGA 1200", "Numero Core: 8
Numero di thread: 16
Frequenza turbo: 5.3GHz
Frequenza base: 3.5GHz
TDP: 125W", 549, 0, "Intel-Core-i9-11900K.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Intel Core i7-11700K", 4, "Processore Intel, Intel Core i9-11xxx serie, numero core: 8, numero threads: 16, litografia: 14nm, cache: 16MB Intel Smart Cache, socket: FCLGA 1200", "Numero Core: 8
Numero di thread: 16
Frequenza turbo: 5 GHz
Frequenza base: 3.6 GHz
TDP: 125W", 363, 0, "Intel-Core-i7-11700K.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Crucial Ballistix 3600 Mhz", 11, "RAM, Crucial Ballistix 16GB Kit(2 x 8GB) DDR4-3600 Desktop Gaming Memory, id: BL2K8G36C16U4B, latenza CAS: 16, timing estesi: 16-18-18-38", "Tecnologia: DDR4
Velocità: DDR4-3600MHz
Capacità: 16GB Kit(8GB x 2)
Forma: UDIMM
Voltaggio: 1.35V", 75.99, 0, "Crucial-Ballistix-3600MHz.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("ASUS ROG B550-F GAMING", 7, "Scheda Madre, CPU: AMD AM4 socket di 3a generazione AMD Ryzen, chipset: AMD b550, memoria: 4 x DIMM, Max. 128GB, DDR4 3600(O.C.)/3200/3000/2800/2666/2400/2133 MHz, grafica: 1 x DisplayPort  1.2, 1 x HDMI 2.1(4K@60HZ)", "Socket: AM4
Formato: ATX
Connettività: PCIe 4.0
USB 3.2 Gen 2
Aura Sync RGB lighting", 182.39, 0, "ASUS-ROG-B550-F-GAMING.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("ASUS ROG Z490-F GAMING", 8, "Scheda Madre, CPU: Intel 10th Gen Intel, chipset: Intel z490, memoria: 4 x DIMM, Max. 128GB, DDR4 3600(O.C.)/3200/3000/2800/2666/2400/2133 MHz, grafica: 1 x DisplayPort  1.2, 1 x HDMI 2.1(4K@60HZ)", "Socket: LGA1200
Formato: ATX
Connettività: PCIe 4.0
USB 3.2 Gen 2
Aura Sync RGB lighting", 337.38, 0, "ASUS-ROG-Z490-F-GAMING.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Western Digital 1TB", 23, "HDD, Western Digital, numero modello: WD10SPZX, fattore di forma: 2.5, dimensioni Hard-Disk: 1000GB, wattaggio: 6W", "Capacità archiviazione: 1TB
Interfaccia: Serial ATA
Dispositivi compatibili: PC", 47.53, 0, "WD-1TB.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Corsair RM850x", 15, "PSU, Alimentatore, Corsair, serie: RM850x, fattore di forma: ATX, peso: 1.7kg", "Wattaggio: 850W
Voltaggio: 220 Volt
Colore: nero
Fattore di forma: ATX", 130.66, 0, "Corsair-RM850x.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Notctua NH-D15", 5, "Accessori, dissipatore ad aria Noctua, serie: NH-D15, voltaggio: 12 Volt, supporto: AM2, AM3, FM1, FM2, AM4, LGA1200, LGA115x, LGA2066, LGA201 1-0, LGA2011-3", "Dimensioni: 15 x 16.1 x 16.5 cm
Metodo di raffreddamento: aria
Dispositivi compatibili: Computer desktop
Livello rumore: 24.6 dB", 99.99, 0, "Noctua-NH-D15.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Corsair ML120", 9, "Accessori, ventole Desktop, Corsair ML120, metodo di raffreddamento: aria, livello di rumore: 35db, velocità massima: 2400 rivoluzioni al minuto, portata flusso: 75 piedi cubici al minuto, confezione da 2 ventole", "Dimensioni: 12.2 x 5.6 x 15 cm
Tensione: 12 Volt
Wattaggio: 5W
Metodo di raffreddamento: Aria", 26.99, 0, "Corsair-ML120.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Corsair K70 RGB", 3, "Accessori, tastiera, tastiera meccanica, Corsair K70 RGB MK.2 MX Red, switch: mx red, colore: RGB", "Descrizione: QWERTY italiano
Connettività: wired
Dispositivi compatibili: PC
Materiale: alluminio", 169.99, 0, "Corsair-K70.png");

INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES ("Razer DeathAdder V2", 7, "Accessori, mouse Razer DeathAdder V2, ergonomia all'avanguardia, switch ottici per mouse Razer™, sensore ottico Razer Focus+, cavo Speedflex Razer, memoria integrata avanzata", "Sensore ottico: 20.000 DPI
Connettività: cavo", 59.65, 0, "Razer-DeathAdder-V2.png");