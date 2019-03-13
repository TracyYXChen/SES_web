# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -17.07, -0.50, 0.08, -41.25, -10.44, -32.15, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -26.85, 13.82, -23.19, -30.96, -24.26, -8.37, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -10.03, -12.12, -27.82, -45.27, 0.47, -5.25, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_5')
