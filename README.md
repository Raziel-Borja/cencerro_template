# Cencerro Base Template

Este repositorio contiene la estructura base (Starter Kit) desarrollada para la creación rápida de plataformas de gestión y tableros administrativos profesionales.

## 🚀 Descripción
El proyecto es una plantilla modular que integra las herramientas esenciales para sistemas SaaS y herramientas de administración empresarial. Está diseñado para ser escalable, seguro y fácil de implementar bajo un entorno PHP/MySQL.

## ✨ Características Principales
- **Gestión de Usuarios:** CRUD completo con sistema de autenticación y manejo de privilegios/roles.
- **Dashboard de Indicadores:** Interfaz preparada para mostrar estadísticas y métricas clave en tiempo real.
- **Calendario Integrado:** Soporte para FullCalendar, ideal para la gestión de agendas, pólizas o eventos.
- **Mapas y Geolocalización:** Integración nativa con Google Maps API para visualización de datos geográficos.
- **Diseño Premium:** Interfaz basada en Bootstrap con un sistema de navegación horizontal responsivo y moderno.
- **API Modular:** Estructura de backend organizada para peticiones RESTful.

## 🛠️ Stack Tecnológico
- **Lenguaje:** PHP 8+
- **Base de Datos:** MySQL
- **Frontend:** Bootstrap 4/5, jQuery, SCSS
- **Librerías:** FullCalendar, Google Maps API, Select2, FontAwesome, MDI Icons

## 📁 Estructura del Proyecto
- `/api`: Lógica del backend y endpoints.
- `/db`: Scripts de conexión y gestión de base de datos.
- `/includes` & `/partials`: Componentes reutilizables de la interfaz.
- `/sections`: Módulos específicos del sistema (Usuarios, Reportes, etc.).
- `/vendors`: Dependencias y librerías externas.

## 💻 Instalación
1. Clona el repositorio:
   ```bash
   git clone https://github.com/Raziel-Borja/cencerro_template.git
   ```
2. Configura los parámetros de conexión en `db/connection.php` (si aplica).
3. Importa la estructura de la base de datos desde `/db`.
4. Despliega en tu servidor local o de producción.

---
Desarrollado por **Cencerro**
