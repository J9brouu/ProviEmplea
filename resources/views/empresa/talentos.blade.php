<x-empresa-layout>

    <div class="space-y-10">

        <!-- Header -->
        <div>
            <h1 class="text-5xl font-bold text-gray-800">
                Vitrina de Talentos
            </h1>
            <p class="text-gray-500 mt-2">
                Búsqueda de talentos disponibles para procesos de selección.
            </p>
        </div>

        <!-- Filtros -->
        <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-4">

                <!-- Buscar -->
                <input type="text" placeholder="Buscar habilidad..."
                    class="h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                <!-- Nivel -->
                <select class="h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option>Nivel Educacional</option>
                    <option>Técnico</option>
                    <option>Profesional</option>
                    <option>Postgrado</option>
                </select>

                <!-- Modalidad -->
                <select class="h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option>Modalidad</option>
                    <option>Remoto</option>
                    <option>Híbrido</option>
                    <option>Presencial</option>
                </select>

                <!-- Experiencia -->
                <select class="h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option>Experiencia</option>
                    <option>Junior</option>
                    <option>Semi Senior</option>
                    <option>Senior</option>
                </select>

                <!-- Inclusión -->
                <select class="h-14 rounded-2xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option>Inclusión</option>
                    <option>Ley 21.015</option>
                </select>

                <!-- Botón -->
                <button class="h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-semibold transition">
                    Buscar
                </button>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

            <!-- CARD -->
            <div
                class="bg-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 p-7 border border-gray-100">

                <!-- Header -->
                <div class="flex justify-between items-start">
                    <div>
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                            Talento #1024
                        </span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-5">
                            Frontend Developer
                        </h2>
                        <p class="text-gray-500 mt-1">
                            3 años de experiencia
                        </p>
                    </div>
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">
                        Disponible
                    </span>
                </div>

                <!-- Resumen -->
                <div class="mt-6">
                    <p class="text-gray-600 leading-relaxed">
                        Desarrollo de aplicaciones web modernas utilizando Laravel,
                        React y TailwindCSS.
                    </p>
                </div>

                <!-- Datos -->
                <div class="mt-6 space-y-3 text-gray-600">
                    <div class="flex items-center gap-2">
                        <span>💼</span>
                        <p>Modalidad: Remoto</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🎓</span>
                        <p>Nivel: Profesional</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>💰</span>
                        <p>Pretensión: $1.200.000</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🌎</span>
                        <p>Idioma: Inglés Intermedio</p>
                    </div>
                </div>

                <!-- Skills -->
                <div class="flex flex-wrap gap-3 mt-7">
                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm font-medium">
                        Laravel
                    </span>
                    <span class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-xl text-sm font-medium">
                        Tailwind
                    </span>
                    <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-sm font-medium">
                        React
                    </span>
                </div>

                <!-- Footer -->
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-medium transition">
                        Ver Perfil
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-medium transition">
                        Solicitar Contacto
                    </button>
                </div>
            </div>

            <!-- CARD -->
            <div
                class="bg-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 p-7 border border-gray-100">

                <!-- Header -->
                <div class="flex justify-between items-start">
                    <div>
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                            Talento #2045
                        </span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-5">
                            Backend Developer
                        </h2>
                        <p class="text-gray-500 mt-1">
                            5 años de experiencia
                        </p>
                    </div>
                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-medium">
                        En Proceso
                    </span>
                </div>

                <!-- Resumen -->
                <div class="mt-6">
                    <p class="text-gray-600 leading-relaxed">
                        Desarrollo de APIs REST y arquitectura backend escalable utilizando Laravel, Docker y MySQL.
                    </p>
                </div>

                <!-- Datos -->
                <div class="mt-6 space-y-3 text-gray-600">
                    <div class="flex items-center gap-2">
                        <span>💼</span>
                        <p>Modalidad: Híbrido</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🎓</span>
                        <p>Nivel: Profesional</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>💰</span>
                        <p>Pretensión: $1.800.000</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🌎</span>
                        <p>Idioma: Inglés Avanzado</p>
                    </div>

                </div>

                <!-- Skills -->
                <div class="flex flex-wrap gap-3 mt-7">
                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm font-medium">
                        Laravel
                    </span>
                    <span class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-xl text-sm font-medium">
                        Docker
                    </span>
                    <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-sm font-medium">
                        MySQL
                    </span>
                </div>

                <!-- Footer -->
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-medium transition">
                        Ver Perfil
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-medium transition">
                        Solicitar Contacto
                    </button>
                </div>
            </div>

            <!-- CARD -->
            <div
                class="bg-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 p-7 border border-gray-100">
                <!-- Header -->

                <div class="flex justify-between items-start">
                    <div>
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                            Talento #8871
                        </span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-5">
                            Data Analyst
                        </h2>
                        <p class="text-gray-500 mt-1">
                            2 años de experiencia
                        </p>
                    </div>
                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-medium">
                        Entrevista
                    </span>
                </div>

                <!-- Resumen -->
                <div class="mt-6">
                    <p class="text-gray-600 leading-relaxed">
                        Análisis de datos empresariales y generación de dashboards interactivos utilizando Power BI y
                        SQL.
                    </p>
                </div>

                <!-- Datos -->
                <div class="mt-6 space-y-3 text-gray-600">
                    <div class="flex items-center gap-2">
                        <span>💼</span>
                        <p>Modalidad: Presencial</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🎓</span>
                        <p>Nivel: Técnico Profesional</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>💰</span>
                        <p>Pretensión: $1.300.000</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>🌎</span>
                        <p>Idioma: Inglés Básico</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>♿</span>
                        <p>Ley 21.015</p>
                    </div>
                </div>

                <!-- Skills -->
                <div class="flex flex-wrap gap-3 mt-7">
                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm font-medium">
                        Power BI
                    </span>
                    <span class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-xl text-sm font-medium">
                        SQL
                    </span>
                    <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-sm font-medium">
                        Python
                    </span>
                </div>

                <!-- Footer -->
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-medium transition">
                        Ver Perfil
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-medium transition">
                        Solicitar Contacto
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</x-empresa-layout>
