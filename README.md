# 🛒 TechHub Store

## Plataforma de E-Commerce Responsiva con PHP OOP + MVC + MySQL

TechHub Store es una plataforma de comercio electrónico orientada a productos tecnológicos. Fue desarrollada como proyecto del módulo **Taller de Aplicaciones para Internet**, utilizando PHP con Programación Orientada a Objetos, arquitectura MVC, MySQL, AJAX, Bootstrap 5, diseño responsivo y entorno local XAMPP para pruebas y desarrollo.

El sistema permite navegar un catálogo dinámico, buscar productos sin recargar la página, registrar usuarios, iniciar sesión, agregar productos al carrito, finalizar compras, revisar historial y administrar productos desde un panel CRUD.

---

## 🌐 URL del Proyecto Online

```text
https://techhubnancy.kesug.com/techhub_store/publico/
```

## 📁 Repositorio GitHub

```text
https://github.com/nancygonzalezrex/techhub-store
```

---

## 🧰 Tecnologías Utilizadas

| Tecnología                 | Uso en el proyecto                                |
| -------------------------- | ------------------------------------------------- |
| PHP 8                      | Backend y lógica del sistema                      |
| PHP OOP                    | Clases Usuario, Producto, Carrito y Orden         |
| MySQL                      | Base de datos relacional                          |
| HTML5                      | Estructura de vistas                              |
| CSS3                       | Estilos personalizados                            |
| JavaScript                 | Interactividad en frontend                        |
| AJAX                       | Búsqueda de productos sin recarga                 |
| Bootstrap 5                | Diseño responsivo y componentes UI                |
| Sesiones PHP (`$_SESSION`) | Carrito persistente y control de usuario logueado |
| Git / GitHub               | Control de versiones y entrega                    |
| InfinityFree               | Hosting gratuito online                           |
| XAMPP                      | Entorno local Apache + MySQL                      |

---

## 🧱 Arquitectura MVC

El proyecto utiliza una arquitectura **MVC (Modelo - Vista - Controlador)** para separar responsabilidades y mantener el código organizado.

### 📌 Modelo

Ubicación:

```text
app/modelos/
```

Clases implementadas:

```text
Producto.php
Usuario.php
Carrito.php
Orden.php
```

Responsabilidad:

- Conectarse con la base de datos.
- Ejecutar consultas SQL.
- Gestionar productos, usuarios, carrito y órdenes.

Ejemplos:

- `Producto.php`: obtiene, crea, edita y elimina productos.
- `Usuario.php`: registra usuarios y valida login.
- `Carrito.php`: administra el carrito mediante sesiones.
- `Orden.php`: crea órdenes y consulta historial de compras.

---

### 📌 Vista

Ubicación:

```text
app/vistas/
```

Vista principal:

```text
productos.php
```

Responsabilidad:

- Mostrar el catálogo.
- Presentar botones de login, historial, carrito y panel admin.
- Mostrar tarjetas de productos con diseño responsivo.

---

### 📌 Controlador

Ubicación:

```text
app/controladores/
```

Controlador principal:

```text
ProductoControlador.php
```

Responsabilidad:

- Recibir la petición desde `index.php`.
- Solicitar los productos al modelo.
- Cargar la vista correspondiente.

---

## 🔁 Diagrama de Arquitectura MVC

```text
┌────────────────────┐
│      Usuario       │
│ Navega el catálogo │
└─────────┬──────────┘
          │
          ▼
┌────────────────────┐
│ publico/index.php  │
│ Punto de entrada   │
└─────────┬──────────┘
          │
          ▼
┌────────────────────────────┐
│ ProductoControlador.php    │
│ Coordina la lógica         │
└─────────┬──────────────────┘
          │
          ▼
┌────────────────────┐
│ Producto.php       │
│ Modelo de datos    │
└─────────┬──────────┘
          │
          ▼
┌────────────────────┐
│ Base de Datos      │
│ MySQL              │
└─────────┬──────────┘
          │
          ▼
┌────────────────────┐
│ productos.php      │
│ Vista del catálogo │
└─────────┬──────────┘
          │
          ▼
┌────────────────────┐
│      Usuario       │
│ Visualiza productos│
└────────────────────┘
```

### Descripción del funcionamiento

El usuario ingresa al sitio mediante `publico/index.php`. Este archivo llama al controlador `ProductoControlador.php`, que solicita los datos al modelo `Producto.php`. Luego el modelo consulta la base de datos MySQL y devuelve los productos. Finalmente, el controlador carga la vista `productos.php`, donde se muestra el catálogo al usuario.

Este diseño basado en MVC permite separar la lógica, los datos y la interfaz, logrando un proyecto más ordenado, mantenible y fácil de ampliar.

---

## ⚙️ Funcionalidades Principales

### 🛍️ Catálogo dinámico

Los productos se cargan desde MySQL. Si un producto se crea desde el panel administrador, aparece automáticamente en el catálogo sin modificar manualmente el HTML.

---

### 🔎 Búsqueda con AJAX

Archivos relacionados:

```text
publico/js/buscador.js
publico/buscar.php
app/modelos/Producto.php
```

Funcionamiento:

1. El usuario escribe en el buscador.
2. JavaScript captura el texto ingresado.
3. AJAX envía la solicitud a `buscar.php`.
4. PHP consulta MySQL.
5. Los resultados se actualizan sin recargar la página.

Esto mejora la experiencia de usuario porque permite una búsqueda rápida y fluida.

---

### 🛒 Carrito de compras persistente con sesión

Archivos relacionados:

```text
app/modelos/Carrito.php
publico/agregar_carrito.php
publico/ver_carrito.php
publico/vaciar_carrito.php
```

La persistencia del carrito se implementó con sesiones PHP:

```php
$_SESSION['carrito']
```

Esto permite conservar los productos mientras el usuario navega dentro del sitio.

---

### 🔐 Sistema de autenticación y registro

Archivos relacionados:

```text
publico/registro.php
publico/login.php
publico/logout.php
app/modelos/Usuario.php
```

Incluye:

- Registro de usuarios.
- Inicio de sesión.
- Cierre de sesión.
- Persistencia de usuario con `$_SESSION`.
- Control por rol de usuario.

Las contraseñas se protegen usando:

```php
password_hash()
password_verify()
```

---

### 🛠️ Panel de administración CRUD

Archivos relacionados:

```text
publico/admin.php
publico/crear_producto.php
publico/editar_producto.php
publico/eliminar_producto.php
app/modelos/Producto.php
```

Operaciones implementadas:

| Acción            | Estado       |
| ----------------- | ------------ |
| Crear producto    | Implementado |
| Listar productos  | Implementado |
| Editar producto   | Implementado |
| Eliminar producto | Implementado |

El panel está protegido mediante sesión y rol de usuario.

---

### 📜 Historial de compras

Archivos relacionados:

```text
publico/finalizar_compra.php
publico/historial.php
app/modelos/Orden.php
```

El sistema guarda:

- Usuario que realiza la compra.
- Fecha de compra.
- Total de la orden.
- Productos comprados.
- Descripción y precio de cada producto.

---

## 🧪 Validación de Datos

Se implementaron validaciones en servidor para evitar datos incorrectos.

Validaciones aplicadas:

- Campos obligatorios.
- Formato correcto de correo electrónico.
- Contraseña mínima de 6 caracteres.
- Precio numérico y mayor a 0.
- Validación antes de guardar en base de datos.

Archivos donde se aplican validaciones:

```text
publico/registro.php
publico/login.php
publico/crear_producto.php
publico/editar_producto.php
```

---

## 🚨 Manejo de Errores y Excepciones

El proyecto incorpora manejo básico de errores usando bloques `try` y `catch`, especialmente en la conexión a la base de datos y operaciones críticas.

Archivo principal:

```text
configuracion/database.php
```

Ejemplo aplicado:

```php
try {
    $conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);

    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;

} catch (Exception $e) {
    die("Ocurrió un problema al conectar con la base de datos: " . $e->getMessage());
}
```

También se reforzaron métodos del modelo `Producto.php` para controlar errores al preparar o ejecutar consultas SQL.

Esto permite detectar fallas de forma más clara y evita que el sistema continúe ejecutándose cuando existe un problema de conexión o consulta.

---

## 🎨 Diseño Responsive y UI/UX

El proyecto utiliza Bootstrap 5 y estilos personalizados.

Archivo principal:

```text
publico/css/estilos.css
```

Se implementó:

- Grid responsive.
- Cards adaptables.
- Tablas responsive.
- Formularios centrados.
- Media queries para celular, tablet y escritorio.
- Efectos hover en tarjetas y botones.
- Botón de carrito destacado.
- Hero principal con degradado moderno.

Ejemplo de media query:

```css
@media (max-width: 576px) {
  .acciones-superiores {
    flex-direction: column;
    align-items: stretch;
  }
}
```

---

## 🗄️ Base de Datos

Nombre local de la base de datos:

```text
techhub
```

Tablas utilizadas:

```text
usuarios
productos
carritos
ordenes
detalles_orden
```

Relaciones principales:

- Un usuario puede tener muchas órdenes.
- Una orden puede tener varios detalles.
- El carrito se relaciona con usuarios y productos.
- Los detalles de orden almacenan la información de productos comprados.

---

## 📄 Script SQL

El script SQL se encuentra en:

```text
database/techhub.sql
```

Incluye:

- Creación de tablas.
- Relaciones.
- Datos iniciales de productos.

---

## 🧭 Estructura del Proyecto

```text
techhub_store/
│
├── app/
│   ├── controladores/
│   │   └── ProductoControlador.php
│   ├── modelos/
│   │   ├── Producto.php
│   │   ├── Usuario.php
│   │   ├── Carrito.php
│   │   └── Orden.php
│   └── vistas/
│       └── productos.php
│
├── configuracion/
│   └── database.php
│
├── publico/
│   ├── css/
│   │   └── estilos.css
│   ├── js/
│   │   └── buscador.js
│   ├── index.php
│   ├── login.php
│   ├── registro.php
│   ├── logout.php
│   ├── admin.php
│   ├── crear_producto.php
│   ├── editar_producto.php
│   ├── eliminar_producto.php
│   ├── agregar_carrito.php
│   ├── ver_carrito.php
│   ├── vaciar_carrito.php
│   ├── finalizar_compra.php
│   └── historial.php
│
├── database/
│   └── techhub.sql
│
└── README.md
```

### Descripción de carpetas principales

#### `app/`

Carpeta principal de la arquitectura MVC. Contiene los controladores, modelos y vistas del sistema.

- `controladores/`: contiene la lógica que conecta el modelo con la vista.
- `modelos/`: contiene las clases PHP que trabajan con datos y base de datos.
- `vistas/`: contiene las pantallas que ve el usuario.

#### `configuracion/`

Carpeta adicional utilizada para centralizar la configuración del proyecto.

Archivo principal:

```text
configuracion/database.php
```

Este archivo contiene los datos de conexión a la base de datos MySQL. Se separa en una carpeta propia para mantener más ordenado el proyecto y evitar repetir la conexión en varios archivos.

#### `publico/`

Carpeta pública del sistema. Contiene los archivos accesibles desde el navegador.

Principales archivos:

- `index.php`: punto de entrada principal del sistema.
- `login.php`: formulario de inicio de sesión.
- `registro.php`: formulario de registro.
- `admin.php`: panel de administración.
- `ver_carrito.php`: vista del carrito de compras.
- `historial.php`: historial de compras del usuario.
- `buscar.php`: archivo utilizado por AJAX para buscar productos sin recargar la página.

Subcarpetas:

- `css/`: contiene `estilos.css`, archivo de diseño visual y responsivo.
- `js/`: contiene `buscador.js`, encargado de la búsqueda dinámica con AJAX.

La carpeta `publico/` permite separar los archivos visibles al usuario de la lógica interna del sistema.

#### `database/`

Carpeta utilizada para guardar el script SQL del proyecto.

Archivo principal:

```text
database/techhub.sql
```

Este archivo permite crear la base de datos, sus tablas, relaciones y datos iniciales.

---

## 🔗 Endpoints y Funciones Principales

| Ruta                             | Función                        |
| -------------------------------- | ------------------------------ |
| `/publico/index.php`             | Catálogo principal             |
| `/publico/buscar.php`            | Búsqueda AJAX de productos     |
| `/publico/login.php`             | Inicio de sesión               |
| `/publico/registro.php`          | Registro de usuarios           |
| `/publico/logout.php`            | Cierre de sesión               |
| `/publico/ver_carrito.php`       | Visualizar carrito             |
| `/publico/agregar_carrito.php`   | Agregar producto al carrito    |
| `/publico/vaciar_carrito.php`    | Vaciar carrito                 |
| `/publico/finalizar_compra.php`  | Finalizar compra y crear orden |
| `/publico/historial.php`         | Ver historial de compras       |
| `/publico/admin.php`             | Panel de administración        |
| `/publico/crear_producto.php`    | Crear producto                 |
| `/publico/editar_producto.php`   | Editar producto                |
| `/publico/eliminar_producto.php` | Eliminar producto              |

---

## 💻 Instalación Local con XAMPP

### 1. Clonar repositorio

```bash
git clone https://github.com/nancygonzalezrex/techhub-store.git
```

### 2. Mover proyecto a `htdocs`

#### En Mac:

```text
/Applications/XAMPP/xamppfiles/htdocs/
```

#### En Windows:

```text
C:\xampp\htdocs\
```

Debe quedar así:

```text
htdocs/techhub_store/
```

### 3. Iniciar XAMPP

Activar:

```text
Apache
MySQL
```

### 4. Crear base de datos

Entrar a:

```text
http://localhost/phpmyadmin
```

Crear base:

```text
techhub
```

Importar:

```text
database/techhub.sql
```

### 5. Configurar conexión local

Archivo:

```text
configuracion/database.php
```

Configuración local:

```php
private $host = "localhost";
private $db = "techhub";
private $user = "root";
private $pass = "";
```

### 6. Ejecutar proyecto

```text
http://localhost/techhub_store/publico/
```

---

## 🔑 Credenciales de Prueba

El sistema permite registrar usuarios nuevos desde:

```text
/publico/registro.php
```

Para facilitar la evaluación, los usuarios registrados pueden acceder al panel administrador según la configuración del proyecto.

---

## ✅ Estado del Proyecto

Proyecto funcional, responsive, documentado y desplegado online.

Funcionalidades completadas:

- Catálogo dinámico.
- Búsqueda AJAX.
- Carrito persistente con sesiones.
- Registro e inicio de sesión.
- Panel administrador CRUD.
- Historial de compras.
- Validaciones en servidor.
- Manejo de errores con `try/catch`.
- Diseño responsive con Bootstrap y media queries.
- Base de datos relacional.
- Despliegue en hosting gratuito.
